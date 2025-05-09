@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Protocol Types</h1>
        </div>
        <div class="col-sm-6">
            <div class="float-sm-right">
                <a href="{{ route('admin.configuration.protocol-types.create') }}" class="btn btn-primary">
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
                    @forelse ($protocolTypes as $protocolType)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $protocolType->name }}</td>
                        <td>{{ $protocolType->code }}</td>
                        <td>{{ $protocolType->description }}</td>
                        <td>
                            <span class="badge badge-{{ $protocolType->is_active ? 'success' : 'danger' }}">
                                {{ $protocolType->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.configuration.protocol-types.edit', $protocolType) }}"
                               class="btn btn-sm btn-info">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.configuration.protocol-types.destroy', $protocolType) }}"
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
                        <td colspan="6" class="text-center">No protocol types found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($protocolTypes->hasPages())
        <div class="card-footer clearfix">
            {{ $protocolTypes->links() }}
        </div>
        @endif
    </div>
</div>
@endsection