<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::latest()->paginate(10);
        return view('admin.configuration.packages.index', compact('packages'));
    }

    public function create()
    {
        return view('admin.configuration.packages.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:packages,name',
            'speed' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        Package::create($validated);

        return redirect()->route('admin.configuration.packages.index')->with('success', 'Package created successfully.');
    }

    public function show(Package $package)
    {
        return view('admin.configuration.packages.show', compact('package'));
    }

    public function edit(Package $package)
    {
        return view('admin.configuration.packages.edit', compact('package'));
    }

    public function update(Request $request, Package $package)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:packages,name,' . $package->id,
            'speed' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        $package->update($validated);

        return redirect()->route('admin.configuration.packages.index')->with('success', 'Package updated successfully.');
    }

    public function destroy(Package $package)
    {
        $package->delete();
        return redirect()->route('admin.configuration.packages.index')->with('success', 'Package deleted successfully.');
    }
}