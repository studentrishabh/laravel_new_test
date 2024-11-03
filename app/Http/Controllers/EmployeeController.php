<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function index(Request $request)
{
  
        $employees = Employees::all();
    
        return view('employees.index', compact('employees'));
}


    public function create(){
        return view('employees.create');
    }
  
    public function edit($id)
    {
        $employee = Employees::findOrFail($id);
        return view('employees.edit', compact('employee'));
    }
    public function show($id)
    {
        $employee = Employees::findOrFail($id);
        return view('employees.view',compact('employee'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'mobile' => 'required|string|max:15',
            'salary' => 'required|numeric',
            'status' => 'in:active,inactive',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $data = $request->all();
        $data['is_active'] = $request->status === 'active' ? 1 : 0;
    
        $employee = Employees::create($data);
        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    public function update(Request $request, $id)
    {
        $employee = Employees::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'mobile' => 'required|string|max:15',
            'salary' => 'required|numeric',
            'status' => 'in:active,inactive',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
    
        $employee->update($request->all());
    
        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }
    
    public function destroy($id)
    {
        $employee = Employees::findOrFail($id);
        $employee->delete();
        
        return response()->json(['message' => 'Employee deleted successfully.']);
    }
    

}
