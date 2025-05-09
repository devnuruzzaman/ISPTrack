<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Box;
use App\Models\SubZone;
use Illuminate\Http\Request;

class BoxController extends Controller
{
    public function index()
    {
        $boxes = Box::with('subZone.zone')->latest()->paginate(10);
        return view('admin.configuration.boxes.index', compact('boxes'));
    }

    public function create()
    {
        $subZones = SubZone::with('zone')->whereHas('zone', function($query) {
            $query->where('is_active', true);
        })->where('is_active', true)->get();
        return view('admin.configuration.boxes.create', compact('subZones'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sub_zone_id' => 'required|exists:sub_zones,id',
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:boxes',
            'location' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        Box::create($request->all());

        return redirect()
            ->route('admin.configuration.boxes.index')
            ->with('success', 'Box created successfully');
    }

    public function edit(Box $box)
    {
        $subZones = SubZone::with('zone')->whereHas('zone', function($query) {
            $query->where('is_active', true);
        })->where('is_active', true)->get();
        return view('admin.configuration.boxes.edit', compact('box', 'subZones'));
    }

    public function update(Request $request, Box $box)
    {
        $request->validate([
            'sub_zone_id' => 'required|exists:sub_zones,id',
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:boxes,code,' . $box->id,
            'location' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        $box->update($request->all());

        return redirect()
            ->route('admin.configuration.boxes.index')
            ->with('success', 'Box updated successfully');
    }

    public function destroy(Box $box)
    {
        $box->delete();

        return redirect()
            ->route('admin.configuration.boxes.index')
            ->with('success', 'Box deleted successfully');
    }
}