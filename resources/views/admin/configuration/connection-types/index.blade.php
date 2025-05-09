@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Connection Types</h1>
        </div>
        <div class="col-sm-6">
            <div class="float-sm-right">
                <a href="{{ route('admin.configuration.connection-types.create') }}" class="btn btn-primary">
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
                        <th>Discount %</th>
                        <th>Status</th>
                        <th style="width: 150px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($connectionTypes as $connectionType)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $connectionType->name }}</td>
                        <td>{{ $connectionType->code }}</td>
                        <td>{{ $connectionType->description }}</td>
                        <td>{{ $connectionType->discount_percentage }}%</td>
                        <td>
                            <span class="badge badge-{{ $connectionType->is_active ? 'success' : 'danger' }}">
                                {{ $connectionType->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.configuration.connection-types.edit', $connectionType) }}"
                               class="btn btn-sm btn-info">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.configuration.connection-types.destroy', $connectionType) }}"
                                  method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">No connection types found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($connectionTypes->hasPages())
        <div class="card-footer clearfix">
            {{ $connectionTypes->links() }}
        </div>
        @endif
    </div>
</div>
@endsection