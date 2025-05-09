<!-- resources/views/client/dashboard.blade.php -->

@extends('layouts.client')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mb-4">Welcome, {{ auth()->user()->name }}</h2>

            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Recent Invoices</h3>
                        </div>
                        <div class="card-body">
                            @if($invoices->count() > 0)
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Invoice #</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Due Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($invoices as $invoice)
                                            <tr>
                                                <td>{{ $invoice->invoice_number }}</td>
                                                <td>{{ $invoice->amount }}</td>
                                                <td><span class="badge bg-{{ $invoice->status }}">{{ $invoice->status }}</span></td>
                                                <td>{{ $invoice->due_date }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p class="text-center">No invoices found.</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Recent Payments</h3>
                        </div>
                        <div class="card-body">
                            @if($payments->count() > 0)
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Payment ID</th>
                                            <th>Amount</th>
                                            <th>Payment Method</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($payments as $payment)
                                            <tr>
                                                <td>{{ $payment->id }}</td>
                                                <td>{{ $payment->amount }}</td>
                                                <td>{{ $payment->payment_method }}</td>
                                                <td><span class="badge bg-{{ $payment->status }}">{{ $payment->status }}</span></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p class="text-center">No payments found.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection