<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubZone;
use App\Models\Zone;
use Illuminate\Http\Request;

class SubZoneController extends Controller
{
    public function index()
    {
        $subZones = SubZone::with('zone')->latest()->paginate(10);
        return view('admin.configuration.sub-zones.index', compact('subZones'));
    }

    public function create()
    {
        $zones = Zone::where('is_active', true)->get();
        return view('admin.configuration.sub-zones.create', compact('zones'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'zone_id' => 'required|exists:zones,id',
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:sub_zones',
            'description' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        SubZone::create($request->all());

        return redirect()
            ->route('admin.configuration.sub-zones.index')
            ->with('success', 'Sub zone created successfully');
    }

    public function edit(SubZone $subZone)
    {
        $zones = Zone::where('is_active', true)->get();
        return view('admin.configuration.sub-zones.edit', compact('subZone', 'zones'));
    }

    public function update(Request $request, SubZone $subZone)
    {
        $request->validate([
            'zone_id' => 'required|exists:zones,id',
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:sub_zones,code,' . $subZone->id,
            'description' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        $subZone->update($request->all());

        return redirect()
            ->route('admin.configuration.sub-zones.index')
            ->with('success', 'Sub zone updated successfully');
    }

    public function destroy(SubZone $subZone)
    {
        $subZone->delete();

        return redirect()
            ->route('admin.configuration.sub-zones.index')
            ->with('success', 'Sub zone deleted successfully');
    }
}