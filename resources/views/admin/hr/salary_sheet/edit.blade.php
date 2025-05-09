@extends('layouts.admin')
@section('content')
    <h1>Edit Salary Sheet</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.hr.salary_sheet.update', $salarySheet->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Employee <span class="text-danger">*</span></label>
            <select name="employee_id" class="form-control" required>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}" {{ $salarySheet->employee_id == $employee->id ? 'selected' : '' }}>
                        {{ $employee->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Month <span class="text-danger">*</span></label>
            <select name="month" class="form-control" required>
                <option value="">Select Month</option>
                @for ($m = 1; $m <= 12; $m++)
                    <option value="{{ $m }}" {{ $salarySheet->month == $m ? 'selected' : '' }}>
                        {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                    </option>
                @endfor
            </select>
        </div>
        <div class="form-group">
            <label>Year <span class="text-danger">*</span></label>
            <input type="number" name="year" class="form-control" value="{{ $salarySheet->year }}" required>
        </div>
        <div class="form-group">
            <label>Gross Salary</label>
            <input type="number" name="gross_salary" class="form-control" step="0.01" value="{{ $salarySheet->gross_salary }}">
        </div>
        <div class="form-group">
            <label>Deductions</label>
            <input type="number" name="deductions" class="form-control" step="0.01" value="{{ $salarySheet->deductions }}">
        </div>
        <div class="form-group">
            <label>Net Salary</label>
            <input type="number" name="net_salary" class="form-control" step="0.01" value="{{ $salarySheet->net_salary }}">
        </div>
        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="Pending" {{ $salarySheet->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Paid" {{ $salarySheet->status == 'Paid' ? 'selected' : '' }}>Paid</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('admin.hr.salary_sheet.index') }}" class="btn btn-secondary">Back to List</a>
    </form>
@endsection