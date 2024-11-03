<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function index(Request $request)
{
   
    $status = $request->get('status', 'active');  
    $is_active = $status === 'active' ? 1 : 0;
    $employees = Employees::where('is_active', $is_active)->get();

    return view('employees.index', compact('employees', 'status'));
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
        return response()->json($employee); 
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
        return redirect()->route('employees.index')
                         ->with('success', 'Employee created successfully.');
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
        return response()->json(['errors' => $validator->errors()], 422);
    }

    $employee->update($request->all());
    return redirect()->back()->with('success', 'Employee updated successfully.');
}


    public function destroy($id)
    {
        $employee = Employees::findOrFail($id);
        $employee->delete();
        return  redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}
