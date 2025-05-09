@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-pink text-white">
            <h3 class="card-title mb-0">
                <img src="{{ asset('images/bkash.png') }}" alt="Bkash Logo" style="height:24px;width:auto;margin-right:8px;">
                bKash Gateway Settings
            </h3>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <form action="{{ route('admin.billings.bkash.update') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="merchant_number">Merchant Number</label>
                    <input type="text" id="merchant_number" name="merchant_number" class="form-control" value="{{ old('merchant_number', $settings->merchant_number ?? '') }}" required>
                </div>
                <!-- Add more fields as needed -->
                <button class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection