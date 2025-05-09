@extends('layouts.admin')
@section('content')
    <h1>Add Network Device</h1>
    <form action="{{ route('admin.network-devices.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Name <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label>IP</label>
            <input type="text" name="ip" class="form-control" value="{{ old('ip') }}">
        </div>
        <div class="form-group">
            <label>Type</label>
            <input type="text" name="type" class="form-control" value="{{ old('type') }}">
        </div>
        <div class="form-group">
            <label>Location</label>
            <input type="text" name="location" class="form-control" value="{{ old('location') }}">
        </div>
        <div class="form-group">
            <label>Info</label>
            <textarea name="info" class="form-control">{{ old('info') }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('admin.network-devices.index') }}" class="btn btn-secondary">Back to List</a>
    </form>
@endsection