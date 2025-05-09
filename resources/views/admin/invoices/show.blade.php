@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Invoice #{{ $invoice->id }}</h3>
                    <div class="card-tools">
                        <div class="btn-group">
                            @if($invoice->status !== 'paid')
                                <form action="{{ route('admin.invoices.mark-as-paid', $invoice) }}"
                                      method="POST"
                                      class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fas fa-check"></i> Mark as Paid
                                    </button>
                                </form>
                                <a href="{{ route('admin.invoices.edit', $invoice) }}"
                                   class="btn btn-warning btn-sm ml-2">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            @endif
                            <a href="{{ route('admin.invoices.index') }}"
                               class="btn btn-default btn-sm ml-2">
                                <i class="fas fa-arrow-left"></i> Back to List
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            <h5>Invoice Details</h5>
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 200px;">Invoice Number</th>
                                    <td>#{{ $invoice->id }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        @if($invoice->status === 'paid')
                                            <span class="badge badge-success">Paid</span>
                                        @elseif($invoice->status === 'partially_paid')
                                            <span class="badge badge-warning">Partially Paid</span>
                                        @elseif($invoice->status === 'overdue')
                                            <span class="badge badge-danger">Overdue</span>
                                        @else
                                            <span class="badge badge-secondary">Unpaid</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Amount</th>
                                    <td>৳{{ number_format($invoice->amount, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>Paid Amount</th>
                                    <td>৳{{ number_format($invoice->paid_amount ?? 0, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>Due Amount</th>
                                    <td>৳{{ number_format($invoice->due_amount, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>Due Date</th>
                                    <td>{{ $invoice->due_date->format('d M, Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Created At</th>
                                    <td>{{ $invoice->created_at->format('d M, Y h:i A') }}</td>
                                </tr>
                                @if($invoice->paid_at)
                                    <tr>
                                        <th>Paid At</th>
                                        <td>{{ $invoice->paid_at->format('d M, Y h:i A') }}</td>
                                    </tr>
                                @endif
                                @if($invoice->description)
                                    <tr>
                                        <th>Description</th>
                                        <td>{{ $invoice->description }}</td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5>Client Information</h5>
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 200px;">Name</th>
                                    <td>
                                        <a href="{{ route('admin.clients.show', $invoice->client) }}">
                                            {{ $invoice->client->name }}
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Connection ID</th>
                                    <td>{{ $invoice->client->connection_id }}</td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td>{{ $invoice->client->phone }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $invoice->client->email ?: 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td>{{ $invoice->client->address }}</td>
                                </tr>
                                <tr>
                                    <th>Package</th>
                                    <td>{{ $invoice->client->package->name }}</td>
                                </tr>
                                <tr>
                                    <th>Monthly Bill</th>
                                    <td>৳{{ number_format($invoice->client->monthly_bill, 2) }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    @if($invoice->payments->isNotEmpty())
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <h5>Payment History</h5>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Amount</th>
                                                <th>Method</th>
                                                <th>Transaction ID</th>
                                                <th>Notes</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($invoice->payments as $payment)
                                                <tr>
                                                    <td>{{ $payment->created_at->format('d M, Y h:i A') }}</td>
                                                    <td>৳{{ number_format($payment->amount, 2) }}</td>
                                                    <td>{{ $payment->payment_method }}</td>
                                                    <td>{{ $payment->transaction_id ?: 'N/A' }}</td>
                                                    <td>{{ $payment->notes ?: 'N/A' }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection