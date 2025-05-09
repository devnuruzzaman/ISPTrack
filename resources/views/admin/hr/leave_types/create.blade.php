@extends('layouts.admin')
@section('content')
    <h1>Add Leave Type</h1>
    <form action="{{ route('admin.hr.leave_types.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Name <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('admin.hr.leave_types.index') }}" class="btn btn-secondary">Back to List</a>
    </form>
@endsection