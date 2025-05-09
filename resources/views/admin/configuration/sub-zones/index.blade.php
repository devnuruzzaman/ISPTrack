@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Sub Zones</h1>
        </div>
        <div class="col-sm-6">
            <div class="float-sm-right">
                <a href="{{ route('admin.configuration.sub-zones.create') }}" class="btn btn-primary">
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
                        <th>Name</th>
                        <th>Code</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th style="width: 150px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($subZones as $subZone)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $subZone->zone->name }}</td>
                        <td>{{ $subZone->name }}</td>
                        <td>{{ $subZone->code }}</td>
                        <td>{{ $subZone->description }}</td>
                        <td>
                            <span class="badge badge-{{ $subZone->is_active ? 'success' : 'danger' }}">
                                {{ $subZone->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.configuration.sub-zones.edit', $subZone) }}"
                               class="btn btn-sm btn-info">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.configuration.sub-zones.destroy', $subZone) }}"
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
                        <td colspan="7" class="text-center">No sub zones found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($subZones->hasPages())
        <div class="card-footer clearfix">
            {{ $subZones->links() }}
        </div>
        @endif
    </div>
</div>
@endsection