@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-warning text-white">
            <h3 class="card-title mb-0">Edit Billing</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.billings.update', $billing->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="client_id">Client ID</label>
                    <input type="text" name="client_id" class="form-control" value="{{ $billing->client_id }}" required>
                </div>
                <div class="form-group">
                    <label for="invoice_number">Invoice No</label>
                    <input type="text" name="invoice_number" class="form-control" value="{{ $billing->invoice_number }}" required>
                </div>
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="number" name="amount" class="form-control" value="{{ $billing->amount }}" required>
                </div>
                <div class="form-group">
                    <label for="discount">Discount</label>
                    <input type="number" name="discount" class="form-control" value="{{ $billing->discount }}">
                </div>
                <div class="form-group">
                    <label for="tax">Tax</label>
                    <input type="number" name="tax" class="form-control" value="{{ $billing->tax }}">
                </div>
                <div class="form-group">
                    <label for="total_amount">Total Amount</label>
                    <input type="number" name="total_amount" class="form-control" value="{{ $billing->total_amount }}" required>
                </div>
                <div class="form-group">
                    <label for="billing_date">Billing Date</label>
                    <input type="date" name="billing_date" class="form-control" value="{{ $billing->billing_date }}" required>
                </div>
                <div class="form-group">
                    <label for="due_date">Due Date</label>
                    <input type="date" name="due_date" class="form-control" value="{{ $billing->due_date }}" required>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" class="form-control" required>
                        <option value="unpaid" {{ $billing->status == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                        <option value="paid" {{ $billing->status == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="partially_paid" {{ $billing->status == 'partially_paid' ? 'selected' : '' }}>Partially Paid</option>
                        <option value="overdue" {{ $billing->status == 'overdue' ? 'selected' : '' }}>Overdue</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="notes">Notes</label>
                    <textarea name="notes" class="form-control">{{ $billing->notes }}</textarea>
                </div>
                <button class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection