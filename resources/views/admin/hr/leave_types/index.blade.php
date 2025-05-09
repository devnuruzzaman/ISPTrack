@extends('layouts.admin')
@section('content')
    <h1>Leave Type List</h1>
    <a href="{{ route('admin.hr.leave_types.create') }}" class="btn btn-primary mb-3">Add Leave Type</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($leave_types as $leave_type)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $leave_type->name }}</td>
                    <td>
                        <a href="{{ route('admin.hr.leave_types.edit', $leave_type->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.hr.leave_types.destroy', $leave_type->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">No leave types found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection