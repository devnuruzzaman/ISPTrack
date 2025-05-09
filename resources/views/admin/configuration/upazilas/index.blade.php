@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Upazilas</h1>
        </div>
        <div class="col-sm-6">
            <div class="float-sm-right">
                <a href="{{ route('admin.configuration.upazilas.create') }}" class="btn btn-primary">
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
                        <th>District</th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Status</th>
                        <th style="width: 150px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($upazilas as $upazila)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $upazila->district->name }}</td>
                        <td>{{ $upazila->name }}</td>
                        <td>{{ $upazila->code }}</td>
                        <td>
                            <span class="badge badge-{{ $upazila->is_active ? 'success' : 'danger' }}">
                                {{ $upazila->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.configuration.upazilas.edit', $upazila) }}"
                               class="btn btn-sm btn-info">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.configuration.upazilas.destroy', $upazila) }}"
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
                        <td colspan="6" class="text-center">No upazilas found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($upazilas->hasPages())
        <div class="card-footer clearfix">
            {{ $upazilas->links() }}
        </div>
        @endif
    </div>
</div>
@endsection