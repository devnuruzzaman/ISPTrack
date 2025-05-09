<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        return view('admin.hr.departments.index', compact('departments'));
    }

    public function create()
    {
        return view('admin.hr.departments.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:departments,name']);
        Department::create($request->all());
        return redirect()->route('admin.hr.departments.index')->with('success', 'Department added!');
    }

    public function show($id)
    {
        $department = Department::findOrFail($id);
        return view('admin.hr.departments.show', compact('department'));
    }

    public function edit($id)
    {
        $department = Department::findOrFail($id);
        return view('admin.hr.departments.edit', compact('department'));
    }

    public function update(Request $request, $id)
    {
        $department = Department::findOrFail($id);
        $request->validate(['name' => 'required|unique:departments,name,' . $department->id]);
        $department->update($request->all());
        return redirect()->route('admin.hr.departments.index')->with('success', 'Department updated!');
    }

    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();
        return redirect()->route('admin.hr.departments.index')->with('success', 'Department deleted!');
    }
}