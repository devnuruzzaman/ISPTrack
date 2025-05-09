<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function index()
    {
        $districts = District::latest()->paginate(10);
        return view('admin.configuration.districts.index', compact('districts'));
    }

    public function create()
    {
        return view('admin.configuration.districts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:districts,name',
            'code' => 'nullable|string|max:50|unique:districts,code',
            'description' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        District::create($validated);

        return redirect()->route('admin.configuration.districts.index')->with('success', 'District created successfully.');
    }

    public function show(District $district)
    {
        return view('admin.configuration.districts.show', compact('district'));
    }

    public function edit(District $district)
    {
        return view('admin.configuration.districts.edit', compact('district'));
    }

    public function update(Request $request, District $district)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:districts,name,' . $district->id,
            'code' => 'nullable|string|max:50|unique:districts,code,' . $district->id,
            'description' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        $district->update($validated);

        return redirect()->route('admin.configuration.districts.index')->with('success', 'District updated successfully.');
    }

    public function destroy(District $district)
    {
        $district->delete();
        return redirect()->route('admin.configuration.districts.index')->with('success', 'District deleted successfully.');
    }
}