@extends('layouts.admin')
@section('content')
    <h1>Edit Department</h1>
    <form action="{{ route('admin.hr.departments.update', $department->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Name <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control" value="{{ $department->name }}" required>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('admin.hr.departments.index') }}" class="btn btn-secondary">Back to List</a>
    </form>
@endsection