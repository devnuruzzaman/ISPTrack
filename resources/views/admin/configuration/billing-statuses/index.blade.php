@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Billing Statuses</h1>
        </div>
        <div class="col-sm-6">
            <div class="float-sm-right">
                <a href="{{ route('admin.configuration.billing-statuses.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Create New
                </a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th style="width: 150px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($statuses as $status)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $status->name }}</td>
                            <td>{{ $status->code }}</td>
                            <td>{{ $status->description }}</td>
                            <td>
                                @if($status->is_active)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <!-- Edit/Delete/View button add koren -->
                                <a href="{{ route('admin.configuration.billing-statuses.edit', $status->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.configuration.billing-statuses.destroy', $status->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No billing statuses found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $statuses->links() }}
        </div>
    </div>
</div>
@endsection