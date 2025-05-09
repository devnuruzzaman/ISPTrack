@extends('layouts.admin')

@section('title', 'Leave Type Setup')

@section('content')
<div class="container">
    <h1>Leave Type Setup</h1>
    <a href="{{ route('admin.LeaveManagement.leave_types.create') }}" class="btn btn-primary mb-3">Add Leave Type</a>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($leaveTypes as $type)
            <tr>
                <td>{{ $type->name }}</td>
                <td>
                    <a href="{{ route('admin.LeaveManagement.leave_types.edit', $type->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('admin.LeaveManagement.leave_types.destroy', $type->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
