@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Boxes</h1>
        </div>
        <div class="col-sm-6">
            <div class="float-sm-right">
                <a href="{{ route('admin.configuration.boxes.create') }}" class="btn btn-primary">
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
                        <th>Zone</th>
                        <th>Sub Zone</th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Location</th>
                        <th>Capacity</th>
                        <th>Used</th>
                        <th>Status</th>
                        <th style="width: 150px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($boxes as $box)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $box->subZone->zone->name }}</td>
                        <td>{{ $box->subZone->name }}</td>
                        <td>{{ $box->name }}</td>
                        <td>{{ $box->code }}</td>
                        <td>{{ $box->location }}</td>
                        <td>{{ $box->capacity }}</td>
                        <td>{{ $box->clients()->count() }}</td>
                        <td>
                            <span class="badge badge-{{ $box->is_active ? 'success' : 'danger' }}">
                                {{ $box->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.configuration.boxes.edit', $box) }}"
                               class="btn btn-sm btn-info">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.configuration.boxes.destroy', $box) }}"
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
                        <td colspan="10" class="text-center">No boxes found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($boxes->hasPages())
        <div class="card-footer clearfix">
            {{ $boxes->links() }}
        </div>
        @endif
    </div>
</div>
@endsection