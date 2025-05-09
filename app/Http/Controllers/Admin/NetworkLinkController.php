<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NetworkLink;
use App\Models\NetworkDevice;

class NetworkLinkController extends Controller
{
    // Link List
    public function index()
    {
        $networkLinks = NetworkLink::with(['fromDevice', 'toDevice'])->get();
        return view('admin.network_links.index', compact('networkLinks'));
    }

    // Show Create Form
    public function create()
    {
        $devices = NetworkDevice::all();
        return view('admin.network_links.create', compact('devices'));
    }

    // Store Link
    public function store(Request $request)
    {
        $request->validate([
            'from_device_id' => 'required|exists:network_devices,id',
            'to_device_id' => 'required|exists:network_devices,id|different:from_device_id',
            'status' => 'nullable|string|max:255',
            'bandwidth' => 'nullable|numeric',
        ]);
        NetworkLink::create($request->all());
        return redirect()->route('admin.network-links.index')->with('success', 'Link added successfully!');
    }

    // Show Edit Form
    public function edit($id)
    {
        $networkLink = NetworkLink::findOrFail($id);
        $devices = NetworkDevice::all();
        return view('admin.network_links.edit', compact('networkLink', 'devices'));
    }

    // Update Link
    public function update(Request $request, $id)
    {
        $request->validate([
            'from_device_id' => 'required|exists:network_devices,id',
            'to_device_id' => 'required|exists:network_devices,id|different:from_device_id',
            'status' => 'nullable|string|max:255',
            'bandwidth' => 'nullable|numeric',
        ]);
        $networkLink = NetworkLink::findOrFail($id);
        $networkLink->update($request->all());
        return redirect()->route('admin.network-links.index')->with('success', 'Link updated successfully!');
    }

    // Delete Link
    public function destroy($id)
    {
        $networkLink = NetworkLink::findOrFail($id);
        $networkLink->delete();
        return redirect()->route('admin.network-links.index')->with('success', 'Link deleted successfully!');
    }
}