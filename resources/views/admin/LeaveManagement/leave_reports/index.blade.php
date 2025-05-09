@extends('layouts.admin')

@section('title', 'Leave Reports')

@section('content')
<div class="container">
    <h1>Leave Reports</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Employee</th>
                <th>Total Leaves</th>
                <th>Approved</th>
                <th>Rejected</th>
                <th>Pending</th>
            </tr>
        </thead>
        <tbody>
            @foreach($leaveReports as $report)
            <tr>
                <td>{{ $report->employee->name }}</td>
                <td>{{ $report->total_leaves }}</td>
                <td>{{ $report->approved }}</td>
                <td>{{ $report->rejected }}</td>
                <td>{{ $report->pending }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
