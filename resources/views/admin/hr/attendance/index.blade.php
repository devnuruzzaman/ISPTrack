@extends('layouts.admin')
@section('content')
    <h1>Attendance List</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <a href="{{ route('admin.hr.attendance.create') }}" class="btn btn-primary mb-3">Add Attendance</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Employee</th>
                <th>Date</th>
                <th>Status</th>
                <th>In Time</th>
                <th>Out Time</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($attendances as $attendance)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $attendance->employee->name ?? '' }}</td>
                    <td>{{ $attendance->date }}</td>
                    <td>{{ $attendance->status }}</td>
                    <td>{{ $attendance->in_time }}</td>
                    <td>{{ $attendance->out_time }}</td>
                    <td>
                        <a href="{{ route('admin.hr.attendance.edit', $attendance->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.hr.attendance.destroy', $attendance->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No attendance records found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection