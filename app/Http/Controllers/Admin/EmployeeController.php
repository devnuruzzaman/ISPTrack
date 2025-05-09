<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with(['department', 'designation'])->get();
        return view('admin.hr.employees.index', compact('employees'));
    }

    public function create()
    {
        $departments = \App\Models\Department::all();
        $designations = \App\Models\Designation::all();
        return view('admin.hr.employees.create', compact('departments', 'designations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'nullable|email|unique:employees,email',
            // ...other validation rules
        ]);
        Employee::create($request->all());
        return redirect()->route('admin.hr.employees.index')->with('success', 'Employee added!');
    }

    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return view('admin.hr.employees.show', compact('employee'));
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        $departments = \App\Models\Department::all();
        $designations = \App\Models\Designation::all();
        return view('admin.hr.employees.edit', compact('employee', 'departments', 'designations'));
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'email' => 'nullable|email|unique:employees,email,' . $employee->id,
            // ...other validation rules
        ]);
        $employee->update($request->all());
        return redirect()->route('admin.hr.employees.index')->with('success', 'Employee updated!');
    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return redirect()->route('admin.hr.employees.index')->with('success', 'Employee deleted!');
    }
}