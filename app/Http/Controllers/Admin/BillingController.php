<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Billing;
use App\Models\GatewaySetting;

class BillingController extends Controller
{
    // Billing List (CRUD)

    public function index()
    {
        $billings = Billing::with('client')->latest()->paginate(20);
        return view('admin.billings.index', compact('billings'));
    }

    public function create()
    {
        return view('admin.billings.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'invoice_number' => 'required|unique:billings,invoice_number',
            'amount' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'tax' => 'nullable|numeric',
            'total_amount' => 'required|numeric',
            'billing_date' => 'required|date',
            'due_date' => 'required|date',
            'status' => 'required|in:unpaid,paid,partially_paid,overdue',
            'notes' => 'nullable|string',
        ]);

        Billing::create($request->all());
        return redirect()->route('admin.billings.index')->with('success', 'Billing created successfully!');
    }

    public function show($id)
    {
        $billing = Billing::with('client')->findOrFail($id);
        return view('admin.billings.show', compact('billing'));
    }

    public function edit($id)
    {
        $billing = Billing::findOrFail($id);
        return view('admin.billings.edit', compact('billing'));
    }

    public function update(Request $request, $id)
    {
        $billing = Billing::findOrFail($id);
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'invoice_number' => 'required|unique:billings,invoice_number,' . $id,
            'amount' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'tax' => 'nullable|numeric',
            'total_amount' => 'required|numeric',
            'billing_date' => 'required|date',
            'due_date' => 'required|date',
            'status' => 'required|in:unpaid,paid,partially_paid,overdue',
            'notes' => 'nullable|string',
        ]);
        $billing->update($request->all());
        return redirect()->route('admin.billings.index')->with('success', 'Billing updated successfully!');
    }

    public function destroy($id)
    {
        $billing = Billing::findOrFail($id);
        $billing->delete();
        return redirect()->route('admin.billings.index')->with('success', 'Billing deleted successfully!');
    }

    // Payment Gateway Methods

    protected function getSettings($gateway)
    {
        return GatewaySetting::where('gateway', $gateway)->first();
    }

    public function bkash()
    {
        $settings = $this->getSettings('bkash');
        return view('admin.billings.bkash', compact('settings'));
    }

    public function bkashUpdate(Request $request)
    {
        $settings = $this->getSettings('bkash');
        $settings->update($request->all());
        return redirect()->route('admin.billings.bkash')->with('success', 'bKash settings updated!');
    }

    public function nagad()
    {
        $settings = $this->getSettings('nagad');
        return view('admin.billings.nagad', compact('settings'));
    }

    public function nagadUpdate(Request $request)
    {
        $settings = $this->getSettings('nagad');
        $settings->update($request->all());
        return redirect()->route('admin.billings.nagad')->with('success', 'Nagad settings updated!');
    }

    public function rocket()
    {
        $settings = $this->getSettings('rocket');
        return view('admin.billings.rocket', compact('settings'));
    }

    public function rocketUpdate(Request $request)
    {
        $settings = $this->getSettings('rocket');
        $settings->update($request->all());
        return redirect()->route('admin.billings.rocket')->with('success', 'Rocket settings updated!');
    }

    public function manual()
    {
        $settings = $this->getSettings('manual');
        return view('admin.billings.manual', compact('settings'));
    }

    public function manualUpdate(Request $request)
    {
        $settings = $this->getSettings('manual');
        $settings->update($request->all());
        return redirect()->route('admin.billings.manual')->with('success', 'Manual settings updated!');
    }

    public function online()
    {
        $settings = $this->getSettings('online');
        return view('admin.billings.online', compact('settings'));
    }

    public function onlineUpdate(Request $request)
    {
        $settings = $this->getSettings('online');
        $settings->update($request->all());
        return redirect()->route('admin.billings.online')->with('success', 'Online settings updated!');
    }
}