@extends('layouts.admin')
@section('content')
    <h1>Edit Designation</h1>
    <form action="{{ route('admin.hr.designations.update', $designation->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Name <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control" value="{{ $designation->name }}" required>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('admin.hr.designations.index') }}" class="btn btn-secondary">Back to List</a>
    </form>
@endsection