<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Designation;

class DesignationController extends Controller
{
    public function index()
    {
        $designations = Designation::all();
        return view('admin.hr.designations.index', compact('designations'));
    }

    public function create()
    {
        return view('admin.hr.designations.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:designations,name']);
        Designation::create($request->all());
        return redirect()->route('admin.hr.designations.index')->with('success', 'Designation added!');
    }

    public function show($id)
    {
        $designation = Designation::findOrFail($id);
        return view('admin.hr.designations.show', compact('designation'));
    }

    public function edit($id)
    {
        $designation = Designation::findOrFail($id);
        return view('admin.hr.designations.edit', compact('designation'));
    }

    public function update(Request $request, $id)
    {
        $designation = Designation::findOrFail($id);
        $request->validate(['name' => 'required|unique:designations,name,' . $designation->id]);
        $designation->update($request->all());
        return redirect()->route('admin.hr.designations.index')->with('success', 'Designation updated!');
    }

    public function destroy($id)
    {
        $designation = Designation::findOrFail($id);
        $designation->delete();
        return redirect()->route('admin.hr.designations.index')->with('success', 'Designation deleted!');
    }
}