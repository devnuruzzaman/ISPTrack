@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Record New Payment</h3>
                    <a href="{{ route('admin.payments.index') }}" class="btn btn-default btn-sm">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>
                <form action="{{ route('admin.payments.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <!-- Client -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="client_id">Client</label>
                                    <select name="client_id" id="client_id" class="form-control @error('client_id') is-invalid @enderror" required>
                                        <option value="">Select Client</option>
                                        @foreach($clients as $client)
                                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('client_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Invoice -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="billing_id">Invoice</label>
                                    <select name="billing_id" id="billing_id" class="form-control @error('billing_id') is-invalid @enderror" required>
                                        <option value="">Select Invoice</option>
                                    </select>
                                    @error('billing_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Amount -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="amount">Amount</label>
                                    <input type="number" step="0.01" name="amount" id="amount" class="form-control @error('amount') is-invalid @enderror" required>
                                    @error('amount')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Payment Method -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="payment_method">Payment Method</label>
                                    <select name="payment_method" id="payment_method" class="form-control @error('payment_method') is-invalid @enderror" required>
                                        <option value="cash">Cash</option>
                                        <option value="bank_transfer">Bank Transfer</option>
                                        <option value="bkash">bKash</option>
                                        <option value="nagad">Nagad</option>
                                        <option value="rocket">Rocket</option>
                                        <option value="other">Other</option>
                                    </select>
                                    @error('payment_method')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Payment Reference -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="payment_reference">Payment Reference</label>
                                    <input type="text" name="payment_reference" id="payment_reference" class="form-control @error('payment_reference') is-invalid @enderror">
                                    @error('payment_reference')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Payment Date -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="payment_date">Payment Date</label>
                                    <input type="text" name="payment_date" id="payment_date" class="form-control @error('payment_date') is-invalid @enderror" required>
                                    @error('payment_date')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Notes -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="notes">Notes</label>
                                    <textarea name="notes" id="notes" rows="3" class="form-control @error('notes') is-invalid @enderror"></textarea>
                                    @error('notes')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Record Payment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
$(document).ready(function() {
    // Load unpaid invoices dynamically when client is selected
    $('#client_id').on('change', function() {
        var clientId = $(this).val();
        if (clientId) {
            $.get('/admin/clients/' + clientId + '/unpaid-invoices', function(data) {
                var options = '<option value="">Select Invoice</option>';
                data.forEach(function(invoice) {
                    var status = invoice.status.charAt(0).toUpperCase() + invoice.status.slice(1);
                    options += `<option value="${invoice.id}" data-amount="${invoice.due_amount}">
                        #${invoice.id} - Due: ৳${invoice.due_amount} - ${status} - Due Date: ${invoice.due_date}
                    </option>`;
                });
                $('#billing_id').html(options);
                $('#amount').val(''); // reset amount
            });
        }
    });

    // Auto-fill amount field when an invoice is selected
    $('#billing_id').on('change', function() {
        var selectedOption = $(this).find('option:selected');
        var dueAmount = selectedOption.data('amount');
        if (dueAmount) {
            $('#amount').val(dueAmount);
        }
    });

    // Flatpickr for payment date
    $('#payment_date').flatpickr({
        dateFormat: "Y-m-d",
        defaultDate: "today"
    });
});
</script>
@endpush
