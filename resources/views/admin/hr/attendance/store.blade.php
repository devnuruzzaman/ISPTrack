@extends('layouts.admin')
@section('content')
    <h1>Add Attendance (Store)</h1>
    <form action="{{ route('admin.hr.attendance.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Employee <span class="text-danger">*</span></label>
            <select name="employee_id" class="form-control" required>
                <option value="">Select Employee</option>
                @foreach($employees ?? [] as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Date <span class="text-danger">*</span></label>
            <input type="date" name="date" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Status <span class="text-danger">*</span></label>
            <select name="status" class="form-control" required>
                <option value="Present">Present</option>
                <option value="Absent">Absent</option>
                <option value="Leave">Leave</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('admin.hr.attendance.index') }}" class="btn btn-secondary">Back to List</a>
    </form>
@endsection