<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ConnectionType;
use Illuminate\Http\Request;

class ConnectionTypeController extends Controller
{
    public function index()
    {
        $connectionTypes = ConnectionType::latest()->paginate(10);
        return view('admin.configuration.connection-types.index', compact('connectionTypes'));
    }

    public function create()
    {
        return view('admin.configuration.connection-types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:connection_types',
            'description' => 'nullable|string',
            'discount_percentage' => 'required|numeric|min:0|max:100',
            'is_active' => 'boolean'
        ]);

        ConnectionType::create($request->all());

        return redirect()
            ->route('admin.configuration.connection-types.index')
            ->with('success', 'Connection type created successfully');
    }

    public function edit(ConnectionType $connectionType)
    {
        return view('admin.configuration.connection-types.edit', compact('connectionType'));
    }

    public function update(Request $request, ConnectionType $connectionType)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:connection_types,code,' . $connectionType->id,
            'description' => 'nullable|string',
            'discount_percentage' => 'required|numeric|min:0|max:100',
            'is_active' => 'boolean'
        ]);

        $connectionType->update($request->all());

        return redirect()
            ->route('admin.configuration.connection-types.index')
            ->with('success', 'Connection type updated successfully');
    }

    public function destroy(ConnectionType $connectionType)
    {
        $connectionType->delete();

        return redirect()
            ->route('admin.configuration.connection-types.index')
            ->with('success', 'Connection type deleted successfully');
    }
}