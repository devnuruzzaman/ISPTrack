<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Invoice;
use App\Models\Client;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with(['client', 'invoice'])
            ->latest()
            ->paginate(10);

        return view('admin.payments.index', compact('payments'));
    }

    public function create()
    {
        $clients = Client::all();
        return view('admin.payments.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'billing_id' => 'required|exists:invoices,id',
            'client_id' => 'required|exists:clients,id',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|in:cash,bank_transfer,bkash,nagad,rocket,other',
            'payment_reference' => 'nullable|string',
            'payment_date' => 'required|date',
            'notes' => 'nullable|string'
        ]);

        $payment = Payment::create($validated);

        // Update invoice status
        $invoice = Invoice::find($validated['billing_id']);
        $totalPaid = $invoice->payments()->sum('amount');

        if ($totalPaid >= $invoice->amount) {
            $invoice->update(['status' => 'paid', 'paid_at' => now()]);
        } elseif ($totalPaid > 0) {
            $invoice->update(['status' => 'partially_paid']);
        }

        return redirect()
            ->route('admin.payments.show', $payment)
            ->with('success', 'Payment recorded successfully');
    }

    public function show(Payment $payment)
    {
        return view('admin.payments.show', compact('payment'));
    }

    public function getUnpaidInvoices(Client $client)
    {
        $invoices = Invoice::where('client_id', $client->id)
            ->whereIn('status', ['unpaid', 'partially_paid', 'overdue'])
            ->get()
            ->map(function ($invoice) {
                return [
                    'id' => $invoice->id,
                    'amount' => $invoice->amount,
                    'due_amount' => $invoice->due_amount,
                    'due_date' => $invoice->due_date->format('d M, Y'),
                    'status' => $invoice->status
                ];
            });

        return response()->json($invoices);
    }

    public function receipt(Payment $payment)
    {
        return view('admin.payments.receipt', compact('payment'));
    }
}
