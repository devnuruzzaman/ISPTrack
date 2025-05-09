@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-info text-white">
            <h3 class="card-title mb-0"><i class="fas fa-globe"></i> Online Payment Gateway Settings</h3>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <form action="{{ route('admin.billings.online.update') }}" method="POST">
                @csrf
                <!-- Online gateway fields -->
                <div class="form-group">
                    <label for="api_key">API Key</label>
                    <input type="text" id="api_key" name="api_key" class="form-control" value="{{ old('api_key', $settings->api_key ?? '') }}" required>
                </div>
                <button class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection