@extends('layouts.admin')
@section('content')
    <h1>Add New Employee</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.hr.employees.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Name <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
        </div>

        <div class="form-group">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
        </div>

        <div class="form-group">
            <label>Address</label>
            <input type="text" name="address" class="form-control" value="{{ old('address') }}">
        </div>

        <div class="form-group">
            <label>Department</label>
            <select name="department_id" class="form-control">
                <option value="">Select Department</option>
                @foreach($departments ?? [] as $department)
                    <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                        {{ $department->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Designation</label>
            <select name="designation_id" class="form-control">
                <option value="">Select Designation</option>
                @foreach($designations ?? [] as $designation)
                    <option value="{{ $designation->id }}" {{ old('designation_id') == $designation->id ? 'selected' : '' }}>
                        {{ $designation->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Joining Date</label>
            <input type="date" name="joining_date" class="form-control" value="{{ old('joining_date') }}">
        </div>

        <div class="form-group">
            <label>Salary</label>
            <input type="number" name="salary" class="form-control" step="0.01" value="{{ old('salary') }}">
        </div>

        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('admin.hr.employees.index') }}" class="btn btn-secondary">Back to List</a>
    </form>
@endsection