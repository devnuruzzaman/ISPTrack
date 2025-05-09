@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-success text-white">
            <h3 class="card-title mb-0">Add New Billing</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.billings.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="client_id">Client ID</label>
                    <input type="text" name="client_id" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="invoice_number">Invoice No</label>
                    <input type="text" name="invoice_number" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="number" name="amount" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="discount">Discount</label>
                    <input type="number" name="discount" class="form-control" value="0">
                </div>
                <div class="form-group">
                    <label for="tax">Tax</label>
                    <input type="number" name="tax" class="form-control" value="0">
                </div>
                <div class="form-group">
                    <label for="total_amount">Total Amount</label>
                    <input type="number" name="total_amount" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="billing_date">Billing Date</label>
                    <input type="date" name="billing_date" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="due_date">Due Date</label>
                    <input type="date" name="due_date" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" class="form-control" required>
                        <option value="unpaid">Unpaid</option>
                        <option value="paid">Paid</option>
                        <option value="partially_paid">Partially Paid</option>
                        <option value="overdue">Overdue</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="notes">Notes</label>
                    <textarea name="notes" class="form-control"></textarea>
                </div>
                <button class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection