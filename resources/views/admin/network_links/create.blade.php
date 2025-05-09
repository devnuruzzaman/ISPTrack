@extends('layouts.admin')
@section('content')
    <h1>Add Network Link</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.network-links.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>From Device <span class="text-danger">*</span></label>
            <select name="from_device_id" class="form-control" required>
                <option value="">Select Device</option>
                @foreach($devices as $device)
                    <option value="{{ $device->id }}" {{ old('from_device_id') == $device->id ? 'selected' : '' }}>{{ $device->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>To Device <span class="text-danger">*</span></label>
            <select name="to_device_id" class="form-control" required>
                <option value="">Select Device</option>
                @foreach($devices as $device)
                    <option value="{{ $device->id }}" {{ old('to_device_id') == $device->id ? 'selected' : '' }}>{{ $device->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Status</label>
            <input type="text" name="status" class="form-control" value="{{ old('status') }}">
        </div>
        <div class="form-group">
            <label>Bandwidth (Mbps)</label>
            <input type="number" name="bandwidth" class="form-control" step="0.01" value="{{ old('bandwidth') }}">
        </div>
        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('admin.network-links.index') }}" class="btn btn-secondary">Back to List</a>
    </form>
@endsection