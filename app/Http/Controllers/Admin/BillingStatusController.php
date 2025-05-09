<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BillingStatus;
use Illuminate\Http\Request;

class BillingStatusController extends Controller
{
    public function index()
    {
        $statuses = BillingStatus::latest()->paginate(10);
        return view('admin.configuration.billing-statuses.index', compact('statuses'));
    }

    public function create()
    {
        return view('admin.configuration.billing-statuses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:billing_statuses,name',
            'description' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        BillingStatus::create($validated);

        return redirect()->route('admin.configuration.billing-statuses.index')->with('success', 'Billing status created successfully.');
    }

    public function show(BillingStatus $billingStatus)
    {
        return view('admin.configuration.billing-statuses.show', compact('billingStatus'));
    }

    public function edit(BillingStatus $billingStatus)
    {
        return view('admin.configuration.billing-statuses.edit', compact('billingStatus'));
    }

    public function update(Request $request, BillingStatus $billingStatus)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:billing_statuses,name,' . $billingStatus->id,
            'description' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        $billingStatus->update($validated);

        return redirect()->route('admin.configuration.billing-statuses.index')->with('success', 'Billing status updated successfully.');
    }

    public function destroy(BillingStatus $billingStatus)
    {
        $billingStatus->delete();
        return redirect()->route('admin.configuration.billing-statuses.index')->with('success', 'Billing status deleted successfully.');
    }
}