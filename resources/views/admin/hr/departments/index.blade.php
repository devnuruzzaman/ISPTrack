@extends('layouts.admin')
@section('content')
    <h1>Department List</h1>
    <a href="{{ route('admin.hr.departments.create') }}" class="btn btn-primary mb-3">Add Department</a>
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
            @forelse($departments as $department)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $department->name }}</td>
                    <td>
                        <a href="{{ route('admin.hr.departments.edit', $department->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.hr.departments.destroy', $department->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">No departments found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
