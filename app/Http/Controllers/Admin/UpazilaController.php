<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Upazila;
use Illuminate\Http\Request;

class UpazilaController extends Controller
{
    public function index()
    {
        $upazilas = Upazila::latest()->paginate(10);
        return view('admin.configuration.upazilas.index', compact('upazilas'));
    }

    public function create()
    {
        $districts = \App\Models\District::all();
    return view('admin.configuration.upazilas.create', compact('districts'));

    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:upazilas,name',
            'code' => 'nullable|string|max:50|unique:upazilas,code',
            'district_id' => 'required|exists:districts,id',
            'description' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        Upazila::create($validated);

        return redirect()->route('admin.configuration.upazilas.index')->with('success', 'Upazila created successfully.');
    }

    public function show(Upazila $upazila)
    {
        return view('admin.configuration.upazilas.show', compact('upazila'));
    }

    public function edit(Upazila $upazila)
    {
        $districts = \App\Models\District::all();
        return view('admin.configuration.upazilas.edit', compact('upazila', 'districts'));
    }

    public function update(Request $request, Upazila $upazila)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:upazilas,name,' . $upazila->id,
            'code' => 'nullable|string|max:50|unique:upazilas,code,' . $upazila->id,
            'district_id' => 'required|exists:districts,id',
            'description' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        $upazila->update($validated);

        return redirect()->route('admin.configuration.upazilas.index')->with('success', 'Upazila updated successfully.');
    }

    public function destroy(Upazila $upazila)
    {
        $upazila->delete();
        return redirect()->route('admin.configuration.upazilas.index')->with('success', 'Upazila deleted successfully.');
    }
}