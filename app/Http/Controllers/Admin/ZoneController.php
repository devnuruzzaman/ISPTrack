<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Zone;
use Illuminate\Http\Request;

class ZoneController extends Controller
{
    public function index()
    {
        $zones = Zone::latest()->paginate(10);
        return view('admin.configuration.zones.index', compact('zones'));
    }

    public function create()
    {
        return view('admin.configuration.zones.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:zones',
            'description' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        Zone::create($request->all());

        return redirect()
            ->route('admin.configuration.zones.index')
            ->with('success', 'Zone created successfully');
    }

    public function edit(Zone $zone)
    {
        return view('admin.configuration.zones.edit', compact('zone'));
    }

    public function update(Request $request, Zone $zone)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:zones,code,' . $zone->id,
            'description' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        $zone->update($request->all());

        return redirect()
            ->route('admin.configuration.zones.index')
            ->with('success', 'Zone updated successfully');
    }

    public function destroy(Zone $zone)
    {
        $zone->delete();

        return redirect()
            ->route('admin.configuration.zones.index')
            ->with('success', 'Zone deleted successfully');
    }
}