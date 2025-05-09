@extends('layouts.admin')

@section('title', 'Leave Balance')

@section('content')
<div class="container">
    <h1>Leave Balance</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Employee</th>
                <th>Leave Type</th>
                <th>Balance</th>
            </tr>
        </thead>
        <tbody>
            @foreach($leaveBalances as $balance)
            <tr>
                <td>{{ $balance->employee->name }}</td>
                <td>{{ $balance->leaveType->name }}</td>
                <td>{{ $balance->balance }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
