@extends('layouts.admin')
@section('content')
    <h1>Add Salary Sheet</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.hr.salary_sheet.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Employee <span class="text-danger">*</span></label>
            <select name="employee_id" class="form-control" required>
                <option value="">Select Employee</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : '' }}>{{ $employee->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Month <span class="text-danger">*</span></label>
            <select name="month" class="form-control" required>
                <option value="">Select Month</option>
                @for ($m = 1; $m <= 12; $m++)
                    <option value="{{ $m }}" {{ old('month') == $m ? 'selected' : '' }}>
                        {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                    </option>
                @endfor
            </select>
        </div>
        <div class="form-group">
            <label>Year <span class="text-danger">*</span></label>
            <select name="year" class="form-control" required>
                <option value="">Select Year</option>
                @php
                    $currentYear = date('Y');
                @endphp
                @for ($y = $currentYear - 10; $y <= $currentYear + 10; $y++)
                    <option value="{{ $y }}" {{ old('year', $currentYear) == $y ? 'selected' : '' }}>{{ $y }}</option>
                @endfor
            </select>
        </div>
        <div class="form-group">
            <label>Gross Salary</label>
            <input type="number" name="gross_salary" class="form-control" step="0.01" value="{{ old('gross_salary') }}">
        </div>
        <div class="form-group">
            <label>Deductions</label>
            <input type="number" name="deductions" class="form-control" step="0.01" value="{{ old('deductions') }}">
        </div>
        <div class="form-group">
            <label>Net Salary</label>
            <input type="number" name="net_salary" class="form-control" step="0.01" value="{{ old('net_salary') }}">
        </div>
        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Paid" {{ old('status') == 'Paid' ? 'selected' : '' }}>Paid</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('admin.hr.salary_sheet.index') }}" class="btn btn-secondary">Back to List</a>
    </form>
@endsection