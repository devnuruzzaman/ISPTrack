@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header"><h3>Create New Device</h3></div>
        <div class="card-body">
            
            <form action="{{ route('admin.configuration.devices.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Device Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>
                <div class="form-group">
                    <label for="type">Device Type</label>
                    <input type="text" name="type" class="form-control" value="{{ old('type') }}">
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" name="is_active" class="form-check-input" value="1" {{ old('is_active', 1) ? 'checked' : '' }}>
                    <label class="form-check-label">Active</label>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
                <a href="{{ route('admin.configuration.devices.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection