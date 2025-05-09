@extends('layouts.admin')
@section('content')
    <h1>Salary Sheet</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <a href="{{ route('admin.hr.salary_sheet.create') }}" class="btn btn-primary mb-3">Add Salary Sheet</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Employee</th>
                <th>Month</th>
                <th>Basic Salary</th>
                <th>Allowances</th>
                <th>Deductions</th>
                <th>Net Salary</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($salarySheets as $salary)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $salary->employee->name ?? '' }}</td>
                    <td>{{ $salary->month }}</td>
                    <td>{{ $salary->basic_salary }}</td>
                    <td>{{ $salary->allowances }}</td>
                    <td>{{ $salary->deductions }}</td>
                    <td>{{ $salary->net_salary }}</td>
                    <td>{{ $salary->status }}</td>
                    <td>
                        <a href="{{ route('admin.hr.salary_sheet.show', $salary->id) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('admin.hr.salary_sheet.edit', $salary->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.hr.salary_sheet.destroy', $salary->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">No salary sheet data found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection