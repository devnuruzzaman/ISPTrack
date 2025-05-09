<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\ClientType;
use App\Models\Package;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::with('package', 'clientType')->latest()->paginate(10);
        return view('admin.clients.index', compact('clients'));
    }

    public function create()
    {
        $clientTypes = ClientType::where('is_active', true)->get();
        $packages = Package::where('is_active', true)->get();
        return view('admin.clients.create', compact('clientTypes', 'packages'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:clients',
            'phone' => 'required|string|max:20|unique:clients',
            'client_type_id' => 'required|exists:client_types,id',
            'package_id' => 'required|exists:packages,id',
            'address' => 'required|string',
            'monthly_bill' => 'required|numeric',
            'status' => 'required|in:active,inactive,suspended,terminated',
            'is_active' => 'boolean',
            // অন্যান্য প্রয়োজনীয় ফিল্ড যোগ করুন
        ]);

        Client::create($validated);

        return redirect()->route('admin.clients.index')->with('success', 'Client created successfully.');
    }

    public function edit(Client $client)
    {
        $clientTypes = ClientType::where('is_active', true)->get();
        $packages = Package::where('is_active', true)->get();
        return view('admin.clients.edit', compact('client', 'clientTypes', 'packages'));
    }

    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:clients,email,' . $client->id,
            'phone' => 'required|string|max:20|unique:clients,phone,' . $client->id,
            'client_type_id' => 'required|exists:client_types,id',
            'package_id' => 'required|exists:packages,id',
            'address' => 'required|string',
            'monthly_bill' => 'required|numeric',
            'status' => 'required|in:active,inactive,suspended,terminated',
            'is_active' => 'boolean',
            // অন্যান্য প্রয়োজনীয় ফিল্ড যোগ করুন
        ]);

        $client->update($validated);

        return redirect()->route('admin.clients.index')->with('success', 'Client updated successfully.');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('admin.clients.index')->with('success', 'Client deleted successfully.');
    }

    public function leftClients()
    {
        $clients = \App\Models\Client::where('status', 'left')->paginate(10);
        return view('admin.clients.left', compact('clients'));
    }

    public function show($id)
    {
        $client = \App\Models\Client::findOrFail($id);
        return view('admin.clients.show', compact('client'));
    }
}