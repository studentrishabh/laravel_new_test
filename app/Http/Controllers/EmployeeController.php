<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
   public function index()
    {
        $employee = Employees::all();
        // dd($users); // Debugging line
        return view('employees.index',compact('employee'));
    }

  
    public function show($id)
    {
        $employee = Employees::findOrFail($id); // Find the employee or fail
        return response()->json($employee); // Return employee data
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'mobile' => 'required|string|max:15',
            'salary' => 'required|numeric',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $employee = Employees::create($request->all());
        return response()->json(['success' => 'Employee created successfully.', 'employee' => $employee]);
    }

    public function update(Request $request, $id)
    {
        $employee = Employees::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'mobile' => 'required|string|max:15',
            'salary' => 'required|numeric',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $employee->update($request->all());
        return response()->json(['success' => 'Employee updated successfully.', 'employee' => $employee]);
    }

    public function destroy($id)
    {
        $employee = Employees::findOrFail($id);
        $employee->delete();
        return response()->json(['success' => 'Employee deleted successfully.']);
    }
}
