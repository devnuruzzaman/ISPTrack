@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create SMS Template</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.sms-templates.index') }}" class="btn btn-default">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.sms-templates.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Template Name</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="code">Template Code</label>
                            <input type="text" name="code" id="code" class="form-control @error('code') is-invalid @enderror" value="{{ old('code') }}" required>
                            @error('code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">A unique code to identify this template (e.g., PAYMENT_REMINDER)</small>
                        </div>

                        <div class="form-group">
                            <label for="type">Template Type</label>
                            <select name="type" id="type" class="form-control @error('type') is-invalid @enderror" required>
                                <option value="">Select Type</option>
                                <option value="billing" {{ old('type') == 'billing' ? 'selected' : '' }}>Billing</option>
                                <option value="support" {{ old('type') == 'support' ? 'selected' : '' }}>Support</option>
                                <option value="notification" {{ old('type') == 'notification' ? 'selected' : '' }}>Notification</option>
                                <option value="marketing" {{ old('type') == 'marketing' ? 'selected' : '' }}>Marketing</option>
                                <option value="other" {{ old('type') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="content">Template Content</label>
                            <textarea name="content" id="content" rows="5" class="form-control @error('content') is-invalid @enderror" required>{{ old('content') }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Use {parameter_name} for dynamic content (e.g., {client_name}, {amount})</small>
                        </div>

                        <div class="form-group">
                            <label for="parameters">Template Parameters (JSON)</label>
                            <textarea name="parameters" id="parameters" rows="3" class="form-control @error('parameters') is-invalid @enderror">{{ old('parameters') }}</textarea>
                            @error('parameters')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Example: {"client_name": "Client Name", "amount": "1000"}</small>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" rows="2" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="is_active">Active</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Create Template</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Auto-generate code from name
    $('#name').on('input', function() {
        if (!$('#code').val()) {
            let code = $(this).val()
                .toUpperCase()
                .replace(/[^A-Z0-9]/g, '_')
                .replace(/_+/g, '_')
                .replace(/^_|_$/g, '');
            $('#code').val(code);
        }
    });

    // Format JSON in parameters field
    $('#parameters').on('blur', function() {
        try {
            let params = JSON.parse($(this).val());
            $(this).val(JSON.stringify(params, null, 2));
            $(this).removeClass('is-invalid');
        } catch (e) {
            if ($(this).val()) {
                $(this).addClass('is-invalid');
            }
        }
    });
});
</script>
@endpush