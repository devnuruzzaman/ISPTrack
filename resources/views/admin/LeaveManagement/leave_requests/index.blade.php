@extends('layouts.admin')

@section('title', 'Leave Requests')

@section('content')
<div class="container">
    <h1>Leave Requests</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Employee</th>
                <th>Leave Type</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($leaveRequests as $request)
            <tr>
                <td>{{ $request->employee->name }}</td>
                <td>{{ $request->leaveType->name }}</td>
                <td>{{ $request->start_date }}</td>
                <td>{{ $request->end_date }}</td>
                <td>{{ $request->status }}</td>
                <td>
                    <form action="{{ route('admin.LeaveManagement.leave_requests.approve', $request->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button class="btn btn-success">Approve</button>
                    </form>
                    <form action="{{ route('admin.LeaveManagement.leave_requests.reject', $request->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button class="btn btn-danger">Reject</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
