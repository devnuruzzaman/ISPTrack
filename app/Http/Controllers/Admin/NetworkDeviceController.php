<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NetworkDevice;
use App\Models\NetworkLink;
use Illuminate\Support\Facades\Storage;

class NetworkDeviceController extends Controller
{
    // Device List
    public function index()
    {
        $networkDevices = NetworkDevice::all();
        return view('admin.network_devices.index', compact('networkDevices'));
    }

    // Show Create Form
    public function create()
    {
        return view('admin.network_devices.create');
    }

    // Store Device
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'ip' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'info' => 'nullable|string',
        ]);
        NetworkDevice::create($request->all());
        return redirect()->route('admin.network-devices.index')->with('success', 'Device added successfully!');
    }

    // Show Edit Form
    public function edit($id)
    {
        $networkDevice = NetworkDevice::findOrFail($id);
        return view('admin.network_devices.edit', compact('networkDevice'));
    }

    // Update Device
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'ip' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'info' => 'nullable|string',
        ]);
        $networkDevice = NetworkDevice::findOrFail($id);
        $networkDevice->update($request->all());
        return redirect()->route('admin.network-devices.index')->with('success', 'Device updated successfully!');
    }

    // Delete Device
    public function destroy($id)
    {
        $networkDevice = NetworkDevice::findOrFail($id);
        $networkDevice->delete();
        return redirect()->route('admin.network-devices.index')->with('success', 'Device deleted successfully!');
    }

    // Topology View (vis.js)
    public function topologyView()
    {
        $devices = NetworkDevice::all();
        $links = NetworkLink::all();

        // vis.js nodes
        $nodes = $devices->map(function($d) {
            return [
                'id' => $d->id,
                'label' => $d->name . "\n" . $d->ip,
                'title' => $d->info,
            ];
        });

        // vis.js edges
        $edges = $links->map(function($l) {
            return [
                'from' => $l->from_device_id,
                'to' => $l->to_device_id,
                'label' => $l->status,
            ];
        });

        // Background map url (if exists)
        $backgroundMapUrl = null;
        if (Storage::exists('public/maps/topology_bg.png')) {
            $backgroundMapUrl = asset('storage/maps/topology_bg.png');
        }

        return view('admin.network_topology', [
            'nodes' => $nodes,
            'edges' => $edges,
            'backgroundMapUrl' => $backgroundMapUrl,
        ]);
    }

    // Upload Background Map
    public function uploadMap(Request $request)
    {
        $request->validate(['background_map' => 'required|image']);
        $request->file('background_map')->storeAs('public/maps', 'topology_bg.png');
        return back()->with('success', 'Background map uploaded!');
    }
}