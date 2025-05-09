@extends('layouts.admin')
@section('content')
    <h1>Add Designation</h1>
    <form action="{{ route('admin.hr.designations.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Name <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('admin.hr.designations.index') }}" class="btn btn-secondary">Back to List</a>
    </form>
@endsection