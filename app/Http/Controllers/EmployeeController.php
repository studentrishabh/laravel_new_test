<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('employees.index'); // Just load the view, no data yet
    }

    // Handle the AJAX request for employee data
    public function getEmployees(Request $request)
    {
        $columns = ['id', 'name', 'email', 'mobile', 'salary', 'is_active'];

        $totalRecords = Employees::count();

        // Fetch employees based on server-side processing parameters
        $employees = Employees::when($request->search['value'], function ($query) use ($request) {
            return $query->where('name', 'like', '%' . $request->search['value'] . '%')
                         ->orWhere('email', 'like', '%' . $request->search['value'] . '%');
        })
        ->skip($request->start)
        ->take($request->length)
        ->get();

        $data = [];
        foreach ($employees as $employee) {
            $data[] = [
                'id' => $employee->id,
                'name' => $employee->name,
                'email' => $employee->email,
                'mobile' => $employee->mobile,
                'salary' => $employee->salary,
                'is_active' => $employee->is_active,
                'action' => '<a href="' . route('employees.edit', $employee->id) . '" class="btn btn-dark">Edit</a>
                             <a href="' . route('employees.view', $employee->id) . '" class="btn btn-primary">View</a>
                             <button class="btn btn-danger" data-id="' . $employee->id . '">Delete</button>',
            ];
        }

        return response()->json([
            'draw' => intval($request->draw),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords, // Adjust this if you implement filtering
            'data' => $data,
        ]);
    }

    // Display the create employee form
    public function create()
    {
        return view('employees.create');
    }

    // Display the edit employee form
    public function edit($id)
    {
        $employee = Employees::findOrFail($id);
        return view('employees.edit', compact('employee'));
    }

    // Display the employee details
    public function show($id)
    {
        $employee = Employees::findOrFail($id);
        return view('employees.view', compact('employee'));
    }

    // Store a newly created employee
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

        Employees::create($data);
        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    public function update(Request $request, $id)
    {
        $employee = Employees::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'mobile' => 'required|digits:10|regex:/^[0-9]+$/',
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
