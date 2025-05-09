<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with('client')
            ->latest()
            ->paginate(20);

        return view('admin.invoices.index', compact('invoices'));
    }

    public function create()
    {
        $clients = Client::where('is_active', true)->get();
        return view('admin.invoices.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'amount' => 'required|numeric|min:0',
            'due_date' => 'required|date',
            'description' => 'nullable|string'
        ]);

        $invoice = Invoice::create($validated);

        return redirect()
            ->route('admin.invoices.index')
            ->with('success', 'Invoice created successfully');
    }

    public function show(Invoice $invoice)
    {
        $invoice->load(['client', 'payments']);
        return view('admin.invoices.show', compact('invoice'));
    }

    public function edit(Invoice $invoice)
    {
        if ($invoice->status === 'paid') {
            return redirect()
                ->route('admin.invoices.index')
                ->with('error', 'Paid invoices cannot be edited');
        }

        $clients = Client::where('is_active', true)->get();
        return view('admin.invoices.edit', compact('invoice', 'clients'));
    }

    public function update(Request $request, Invoice $invoice)
    {
        if ($invoice->status === 'paid') {
            return redirect()
                ->route('admin.invoices.index')
                ->with('error', 'Paid invoices cannot be edited');
        }

        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'amount' => 'required|numeric|min:0',
            'due_date' => 'required|date',
            'description' => 'nullable|string'
        ]);

        $invoice->update($validated);

        return redirect()
            ->route('admin.invoices.index')
            ->with('success', 'Invoice updated successfully');
    }

    public function destroy(Invoice $invoice)
    {
        if ($invoice->status === 'paid') {
            return redirect()
                ->route('admin.invoices.index')
                ->with('error', 'Paid invoices cannot be deleted');
        }

        $invoice->delete();

        return redirect()
            ->route('admin.invoices.index')
            ->with('success', 'Invoice deleted successfully');
    }

    public function generateMonthlyInvoices()
    {
        $today = now();

        // Get all active clients whose billing cycle day matches today
        $clients = Client::where('is_active', true)
            ->where('billing_cycle', $today->day)
            ->get();

        DB::transaction(function () use ($clients, $today) {
            foreach ($clients as $client) {
                Invoice::create([
                    'client_id' => $client->id,
                    'amount' => $client->monthly_bill,
                    'due_date' => $today->copy()->addDays(7), // Due in 7 days
                    'description' => 'Monthly bill for ' . $today->format('F Y'),
                ]);
            }
        });

        return redirect()
            ->route('admin.invoices.index')
            ->with('success', 'Monthly invoices generated successfully');
    }

    public function markAsPaid(Invoice $invoice)
    {
        if ($invoice->status === 'paid') {
            return redirect()
                ->route('admin.invoices.show', $invoice)
                ->with('error', 'Invoice is already paid');
        }

        $invoice->markAsPaid();

        return redirect()
            ->route('admin.invoices.show', $invoice)
            ->with('success', 'Invoice marked as paid successfully');
    }
}