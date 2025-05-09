@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Clients</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.clients.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Add New Client
                        </a>
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
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Connection ID</th>
                                    <th>Phone</th>
                                    <th>Package</th>
                                    <th>Monthly Bill</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($clients as $client)
                                    <tr>
                                        <td>{{ $client->id }}</td>
                                        <td>
                                            <a href="{{ route('admin.clients.show', $client) }}">
                                                {{ $client->name }}
                                            </a>
                                        </td>
                                        <td>{{ $client->connection_id }}</td>
                                        <td>{{ $client->phone }}</td>
                                        <td>{{ $client->package->name }}</td>
                                        <td>৳{{ number_format($client->monthly_bill, 2) }}</td>
                                        <td>
                                            @if($client->is_active)
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('admin.clients.show', $client) }}"
                                                   class="btn btn-info btn-sm"
                                                   title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.clients.edit', $client) }}"
                                                   class="btn btn-warning btn-sm"
                                                   title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button"
                                                        class="btn btn-danger btn-sm"
                                                        title="Delete"
                                                        onclick="confirmDelete({{ $client->id }})">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>

                                            <form id="delete-form-{{ $client->id }}"
                                                  action="{{ route('admin.clients.destroy', $client) }}"
                                                  method="POST"
                                                  style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">No clients found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $clients->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function confirmDelete(clientId) {
    if (confirm('Are you sure you want to delete this client?')) {
        document.getElementById('delete-form-' + clientId).submit();
    }
}
</script>
@endpush