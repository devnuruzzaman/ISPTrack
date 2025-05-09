@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Client Details: {{ $client->name }}</h3>
                    <div class="card-tools">
                        <div class="btn-group">
                            <a href="{{ route('admin.clients.edit', $client) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="{{ route('admin.clients.index') }}" class="btn btn-default btn-sm">
                                <i class="fas fa-arrow-left"></i> Back to List
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 200px;">Name</th>
                                    <td>{{ $client->name }}</td>
                                </tr>
                                <tr>
                                    <th>Connection ID</th>
                                    <td>{{ $client->connection_id }}</td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td>{{ $client->phone }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $client->email ?: 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td>{{ $client->address }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        @if($client->is_active)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 200px;">Package</th>
                                    <td>{{ $client->package->name }}</td>
                                </tr>
                                <tr>
                                    <th>Monthly Bill</th>
                                    <td>৳{{ number_format($client->monthly_bill, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>Billing Cycle Day</th>
                                    <td>{{ $client->billing_cycle }}</td>
                                </tr>
                                <tr>
                                    <th>Due Date</th>
                                    <td>{{ $client->due_date->format('d M, Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Created At</th>
                                    <td>{{ $client->created_at->format('d M, Y h:i A') }}</td>
                                </tr>
                                <tr>
                                    <th>Notes</th>
                                    <td>{{ $client->notes ?: 'N/A' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Recent Invoices</h3>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-striped mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Invoice #</th>
                                                    <th>Amount</th>
                                                    <th>Status</th>
                                                    <th>Due Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($client->invoices as $invoice)
                                                    <tr>
                                                        <td>{{ $invoice->id }}</td>
                                                        <td>৳{{ number_format($invoice->amount, 2) }}</td>
                                                        <td>
                                                            @if($invoice->status === 'paid')
                                                                <span class="badge badge-success">Paid</span>
                                                            @else
                                                                <span class="badge badge-danger">Unpaid</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ $invoice->due_date->format('d M, Y') }}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4" class="text-center">No invoices found.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Recent Payments</h3>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-striped mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Amount</th>
                                                    <th>Method</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($client->payments as $payment)
                                                    <tr>
                                                        <td>{{ $payment->created_at->format('d M, Y') }}</td>
                                                        <td>৳{{ number_format($payment->amount, 2) }}</td>
                                                        <td>{{ $payment->payment_method }}</td>
                                                        <td>
                                                            <span class="badge badge-success">Success</span>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4" class="text-center">No payments found.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection