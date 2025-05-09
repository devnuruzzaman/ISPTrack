@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-info text-white">
            <h3 class="card-title mb-0">Billing Details</h3>
        </div>
        <div class="card-body">
            <p><strong>Client:</strong> {{ $billing->client->name ?? '-' }}</p>
            <p><strong>Invoice No:</strong> {{ $billing->invoice_number }}</p>
            <p><strong>Amount:</strong> {{ number_format($billing->amount, 2) }}</p>
            <p><strong>Discount:</strong> {{ number_format($billing->discount, 2) }}</p>
            <p><strong>Tax:</strong> {{ number_format($billing->tax, 2) }}</p>
            <p><strong>Total Amount:</strong> {{ number_format($billing->total_amount, 2) }}</p>
            <p><strong>Billing Date:</strong> {{ $billing->billing_date }}</p>
            <p><strong>Due Date:</strong> {{ $billing->due_date }}</p>
            <p><strong>Status:</strong> {{ ucfirst($billing->status) }}</p>
            <p><strong>Notes:</strong> {{ $billing->notes }}</p>
            <a href="{{ route('admin.billings.edit', $billing->id) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('admin.billings.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</div>
@endsection