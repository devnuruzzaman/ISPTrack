@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Invoices</h3>
                    <div class="card-tools">
                        <div class="btn-group">
                            <a href="{{ route('admin.invoices.create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> Create Invoice
                            </a>
                            <form action="{{ route('admin.invoices.generate-monthly') }}"
                                  method="POST"
                                  class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm ml-2">
                                    <i class="fas fa-sync"></i> Generate Monthly Invoices
                                </button>
                            </form>
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

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Invoice #</th>
                                    <th>Client</th>
                                    <th>Amount</th>
                                    <th>Due Date</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($invoices as $invoice)
                                    <tr>
                                        <td>{{ $invoice->id }}</td>
                                        <td>
                                            <a href="{{ route('admin.clients.show', $invoice->client) }}">
                                                {{ $invoice->client->name }}
                                            </a>
                                        </td>
                                        <td>৳{{ number_format($invoice->amount, 2) }}</td>
                                        <td>{{ $invoice->due_date->format('d M, Y') }}</td>
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
                                        <td>{{ $invoice->created_at->format('d M, Y') }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('admin.invoices.show', $invoice) }}"
                                                   class="btn btn-info btn-sm"
                                                   title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a>

                                                @if($invoice->status !== 'paid')
                                                    <a href="{{ route('admin.invoices.edit', $invoice) }}"
                                                       class="btn btn-warning btn-sm"
                                                       title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                    <form action="{{ route('admin.invoices.mark-as-paid', $invoice) }}"
                                                          method="POST"
                                                          class="d-inline">
                                                        @csrf
                                                        <button type="submit"
                                                                class="btn btn-success btn-sm"
                                                                title="Mark as Paid">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                    </form>

                                                    <button type="button"
                                                            class="btn btn-danger btn-sm"
                                                            title="Delete"
                                                            onclick="confirmDelete({{ $invoice->id }})">
                                                        <i class="fas fa-trash"></i>
                                                    </button>

                                                    <form id="delete-form-{{ $invoice->id }}"
                                                          action="{{ route('admin.invoices.destroy', $invoice) }}"
                                                          method="POST"
                                                          style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No invoices found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $invoices->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function confirmDelete(invoiceId) {
    if (confirm('Are you sure you want to delete this invoice?')) {
        document.getElementById('delete-form-' + invoiceId).submit();
    }
}
</script>
@endpush