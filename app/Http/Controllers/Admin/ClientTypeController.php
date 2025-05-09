<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClientType;
use Illuminate\Http\Request;

class ClientTypeController extends Controller
{
    public function index()
    {
        $clientTypes = ClientType::latest()->paginate(10);
        return view('admin.configuration.client-types.index', compact('clientTypes'));
    }

    public function create()
    {
        return view('admin.configuration.client-types.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:client_types,name',
            'description' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        ClientType::create($validated);

        return redirect()->route('admin.client-types.index')->with('success', 'Client type created successfully.');
    }

    public function edit(ClientType $clientType)
    {
        return view('admin.configuration.client-types.edit', compact('clientType'));
    }

    public function update(Request $request, ClientType $clientType)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:client_types,name,' . $clientType->id,
            'description' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        $clientType->update($validated);

        return redirect()->route('admin.client-types.index')->with('success', 'Client type updated successfully.');
    }

    public function destroy(ClientType $clientType)
    {
        $clientType->delete();
        return redirect()->route('admin.client-types.index')->with('success', 'Client type deleted successfully.');
    }
}