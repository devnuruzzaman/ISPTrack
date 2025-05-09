@extends('layouts.admin')
@section('content')
    <h1>Edit Leave Type</h1>
    <form action="{{ route('admin.hr.leave_types.update', $leave_type->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Name <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control" value="{{ $leave_type->name }}" required>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('admin.hr.leave_types.index') }}" class="btn btn-secondary">Back to List</a>
    </form>
@endsection