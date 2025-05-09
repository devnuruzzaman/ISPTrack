@extends('layouts.admin')
@section('content')
    <h1>Add Department</h1>
    <form action="{{ route('admin.hr.departments.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Name <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('admin.hr.departments.index') }}" class="btn btn-secondary">Back to List</a>
    </form>
@endsection