<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function index()
    {
        $devices = Device::latest()->paginate(10);
        return view('admin.configuration.devices.index', compact('devices'));
    }

    public function create()
    {
        return view('admin.configuration.devices.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:devices,name',
            'type' => 'required|string|max:100',
            'serial_number' => 'nullable|string|max:100|unique:devices,serial_number',
            'description' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        Device::create($validated);

        return redirect()->route('admin.configuration.devices.index')->with('success', 'Device created successfully.');
    }

    public function show(Device $device)
    {
        return view('admin.configuration.devices.show', compact('device'));
    }

    public function edit(Device $device)
    {
        return view('admin.configuration.devices.edit', compact('device'));
    }

    public function update(Request $request, Device $device)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:devices,name,' . $device->id,
            'type' => 'required|string|max:100',
            'serial_number' => 'nullable|string|max:100|unique:devices,serial_number,' . $device->id,
            'description' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        $device->update($validated);

        return redirect()->route('admin.configuration.devices.index')->with('success', 'Device updated successfully.');
    }

    public function destroy(Device $device)
    {
        $device->delete();
        return redirect()->route('admin.configuration.devices.index')->with('success', 'Device deleted successfully.');
    }
}