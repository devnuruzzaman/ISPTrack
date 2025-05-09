@extends('layouts.admin')
@section('content')
    <h1>Edit Network Device</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.network-devices.update', $networkDevice->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Name <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control" required value="{{ old('name', $networkDevice->name) }}">
        </div>
        <div class="form-group">
            <label>IP</label>
            <input type="text" name="ip" class="form-control" value="{{ old('ip', $networkDevice->ip) }}">
        </div>
        <div class="form-group">
            <label>Type</label>
            <input type="text" name="type" class="form-control" value="{{ old('type', $networkDevice->type) }}">
        </div>
        <div class="form-group">
            <label>Location</label>
            <input type="text" name="location" class="form-control" value="{{ old('location', $networkDevice->location) }}">
        </div>
        <div class="form-group">
            <label>Info</label>
            <textarea name="info" class="form-control">{{ old('info', $networkDevice->info) }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('admin.network-devices.index') }}" class="btn btn-secondary">Back to List</a>
    </form>
@endsection