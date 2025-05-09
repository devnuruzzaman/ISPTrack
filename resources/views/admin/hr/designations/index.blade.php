@extends('layouts.admin')
@section('content')
    <h1>Designation List</h1>
    <a href="{{ route('admin.hr.designations.create') }}" class="btn btn-primary mb-3">Add Designation</a>
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
            @forelse($designations as $designation)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $designation->name }}</td>
                    <td>
                        <a href="{{ route('admin.hr.designations.edit', $designation->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.hr.designations.destroy', $designation->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">No designations found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection