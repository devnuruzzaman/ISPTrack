<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProtocolType;
use Illuminate\Http\Request;

class ProtocolTypeController extends Controller
{
    public function index()
    {
        $protocolTypes = ProtocolType::latest()->paginate(10);
        return view('admin.configuration.protocol-types.index', compact('protocolTypes'));
    }

    public function create()
    {
        return view('admin.configuration.protocol-types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:protocol_types',
            'description' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        ProtocolType::create($request->all());

        return redirect()
            ->route('admin.configuration.protocol-types.index')
            ->with('success', 'Protocol type created successfully');
    }

    public function edit(ProtocolType $protocolType)
    {
        return view('admin.configuration.protocol-types.edit', compact('protocolType'));
    }

    public function update(Request $request, ProtocolType $protocolType)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:protocol_types,code,' . $protocolType->id,
            'description' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        $protocolType->update($request->all());

        return redirect()
            ->route('admin.configuration.protocol-types.index')
            ->with('success', 'Protocol type updated successfully');
    }

    public function destroy(ProtocolType $protocolType)
    {
        $protocolType->delete();

        return redirect()
            ->route('admin.configuration.protocol-types.index')
            ->with('success', 'Protocol type deleted successfully');
    }
}