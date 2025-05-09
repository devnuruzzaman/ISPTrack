@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title mb-0">Billing List</h3>
            <div class="card-tools">
                <a href="{{ route('admin.billings.create') }}" class="btn btn-success btn-sm">
                    <i class="fas fa-plus"></i> Add New Billing
                </a>
            </div>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Client</th>
                        <th>Invoice No</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Billing Date</th>
                        <th>Due Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($billings as $billing)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $billing->client->name ?? '-' }}</td>
                        <td>{{ $billing->invoice_number }}</td>
                        <td>{{ number_format($billing->amount, 2) }}</td>
                        <td>
                            @if($billing->status == 'paid')
                                <span class="badge badge-success">Paid</span>
                            @elseif($billing->status == 'unpaid')
                                <span class="badge badge-danger">Unpaid</span>
                            @elseif($billing->status == 'partially_paid')
                                <span class="badge badge-warning">Partially Paid</span>
                            @else
                                <span class="badge badge-secondary">Overdue</span>
                            @endif
                        </td>
                        <td>{{ $billing->billing_date }}</td>
                        <td>{{ $billing->due_date }}</td>
                        <td>
                            <a href="{{ route('admin.billings.show', $billing->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('admin.billings.edit', $billing->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.billings.destroy', $billing->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Delete?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $billings->links() }}
        </div>
    </div>
</div>
@endsection