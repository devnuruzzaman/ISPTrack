@extends('layouts.admin')
@section('content')
    <h1>Edit Attendance</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.hr.attendance.update', $attendance->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Employee <span class="text-danger">*</span></label>
            <select name="employee_id" class="form-control" required>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}" {{ $attendance->employee_id == $employee->id ? 'selected' : '' }}>
                        {{ $employee->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Date <span class="text-danger">*</span></label>
            <input type="date" name="date" class="form-control" value="{{ $attendance->date }}" required>
        </div>
        <div class="form-group">
            <label>Status <span class="text-danger">*</span></label>
            <select name="status" class="form-control" required>
                <option value="Present" {{ $attendance->status == 'Present' ? 'selected' : '' }}>Present</option>
                <option value="Absent" {{ $attendance->status == 'Absent' ? 'selected' : '' }}>Absent</option>
                <option value="Leave" {{ $attendance->status == 'Leave' ? 'selected' : '' }}>Leave</option>
            </select>
        </div>
        <div class="form-group">
            <label>In Time</label>
            <input type="time" name="in_time" class="form-control" value="{{ $attendance->in_time }}">
        </div>
        <div class="form-group">
            <label>Out Time</label>
            <input type="time" name="out_time" class="form-control" value="{{ $attendance->out_time }}">
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('admin.hr.attendance.index') }}" class="btn btn-secondary">Back to List</a>
    </form>
@endsection