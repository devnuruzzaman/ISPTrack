@extends('layouts.admin')
@section('content')
    <h1>Salary Sheet Details</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <a href="{{ route('admin.hr.salary_sheet.index') }}" class="btn btn-secondary mb-3">Back to List</a>

    <table class="table table-bordered">
        <tr>
            <th>Employee</th>
            <td>{{ $salarySheet->employee->name ?? '' }}</td>
        </tr>
        <tr>
            <th>Month</th>
            <td>{{ DateTime::createFromFormat('!m', $salarySheet->month)->format('F') }}</td>
        </tr>
        <tr>
            <th>Year</th>
            <td>{{ $salarySheet->year }}</td>
        </tr>
        <tr>
            <th>Gross Salary</th>
            <td>{{ $salarySheet->gross_salary }}</td>
        </tr>
        <tr>
            <th>Deductions</th>
            <td>{{ $salarySheet->deductions }}</td>
        </tr>
        <tr>
            <th>Net Salary</th>
            <td>{{ $salarySheet->net_salary }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ $salarySheet->status }}</td>
        </tr>
    </table>
@endsection