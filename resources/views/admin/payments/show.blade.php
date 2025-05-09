@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Payment Details</h3>
                    <div class="card-tools d-flex">
                        <a href="{{ route('admin.payments.index') }}" class="btn btn-default btn-sm">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                        <a href="{{ route('admin.payments.receipt', $payment) }}" class="btn btn-info btn-sm ml-2" target="_blank">
                            <i class="fas fa-print"></i> Print Receipt
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Payment Information</h5>
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 200px;">Payment ID</th>
                                    <td>#{{ $payment->id }}</td>
                                </tr>
                                <tr>
                                    <th>Amount</th>
                                    <td>৳{{ number_format($payment->amount, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>Payment Method</th>
                                    <td>{{ ucfirst($payment->payment_method) }}</td>
                                </tr>
                                <tr>
                                    <th>Payment Reference</th>
                                    <td>{{ $payment->payment_reference ?: 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Payment Date</th>
                                    <td>{{ $payment->payment_date->format('d M, Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        <span class="badge badge-{{ $payment->status === 'completed' ? 'success' : 'warning' }}">
                                            {{ ucfirst($payment->status) }}
                                        </span>
                                    </td>
                                </tr>
                                @if($payment->notes)
                                <tr>
                                    <th>Notes</th>
                                    <td>{{ $payment->notes }}</td>
                                </tr>
                                @endif
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5>Invoice & Client Information</h5>
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 200px;">Invoice Number</th>
                                    <td>#{{ $payment->invoice->id }}</td>
                                </tr>
                                <tr>
                                    <th>Invoice Amount</th>
                                    <td>৳{{ number_format($payment->invoice->amount, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>Client Name</th>
                                    <td>{{ $payment->client->name }}</td>
                                </tr>
                                <tr>
                                    <th>Client Phone</th>
                                    <td>{{ $payment->client->phone }}</td>
                                </tr>
                                <tr>
                                    <th>Client Email</th>
                                    <td>{{ $payment->client->email ?: 'N/A' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
