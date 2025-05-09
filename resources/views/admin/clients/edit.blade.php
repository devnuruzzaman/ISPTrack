@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Client: {{ $client->name }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.clients.index') }}" class="btn btn-default btn-sm">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.clients.update', $client) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    <input type="text"
                                           name="name"
                                           id="name"
                                           class="form-control @error('name') is-invalid @enderror"
                                           value="{{ old('name', $client->name) }}"
                                           required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email"
                                           name="email"
                                           id="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           value="{{ old('email', $client->email) }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="phone">Phone <span class="text-danger">*</span></label>
                                    <input type="text"
                                           name="phone"
                                           id="phone"
                                           class="form-control @error('phone') is-invalid @enderror"
                                           value="{{ old('phone', $client->phone) }}"
                                           required>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="address">Address <span class="text-danger">*</span></label>
                                    <textarea name="address"
                                              id="address"
                                              class="form-control @error('address') is-invalid @enderror"
                                              rows="3"
                                              required>{{ old('address', $client->address) }}</textarea>
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="package_id">Package <span class="text-danger">*</span></label>
                                    <select name="package_id"
                                            id="package_id"
                                            class="form-control @error('package_id') is-invalid @enderror"
                                            required>
                                        <option value="">Select Package</option>
                                        @foreach($packages as $package)
                                            <option value="{{ $package->id }}"
                                                    data-price="{{ $package->price }}"
                                                    {{ old('package_id', $client->package_id) == $package->id ? 'selected' : '' }}>
                                                {{ $package->name }} (৳{{ number_format($package->price, 2) }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('package_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="connection_id">Connection ID <span class="text-danger">*</span></label>
                                    <input type="text"
                                           name="connection_id"
                                           id="connection_id"
                                           class="form-control @error('connection_id') is-invalid @enderror"
                                           value="{{ old('connection_id', $client->connection_id) }}"
                                           required>
                                    @error('connection_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="monthly_bill">Monthly Bill <span class="text-danger">*</span></label>
                                    <input type="number"
                                           name="monthly_bill"
                                           id="monthly_bill"
                                           class="form-control @error('monthly_bill') is-invalid @enderror"
                                           value="{{ old('monthly_bill', $client->monthly_bill) }}"
                                           step="0.01"
                                           required>
                                    @error('monthly_bill')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="billing_cycle">Billing Cycle Day <span class="text-danger">*</span></label>
                                    <input type="number"
                                           name="billing_cycle"
                                           id="billing_cycle"
                                           class="form-control @error('billing_cycle') is-invalid @enderror"
                                           value="{{ old('billing_cycle', $client->billing_cycle) }}"
                                           min="1"
                                           max="31"
                                           required>
                                    @error('billing_cycle')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="due_date">Due Date <span class="text-danger">*</span></label>
                                    <input type="date"
                                           name="due_date"
                                           id="due_date"
                                           class="form-control @error('due_date') is-invalid @enderror"
                                           value="{{ old('due_date', $client->due_date->format('Y-m-d')) }}"
                                           required>
                                    @error('due_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="notes">Notes</label>
                                    <textarea name="notes"
                                              id="notes"
                                              class="form-control @error('notes') is-invalid @enderror"
                                              rows="3">{{ old('notes', $client->notes) }}</textarea>
                                    @error('notes')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox"
                                               name="is_active"
                                               class="custom-control-input"
                                               id="is_active"
                                               value="1"
                                               {{ old('is_active', $client->is_active) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="is_active">Active</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Update Client
                                </button>
                            </div>
                        </div>
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
    // Auto-fill monthly bill when package is selected
    $('#package_id').change(function() {
        const selectedOption = $(this).find('option:selected');
        const price = selectedOption.data('price');
        if (price) {
            $('#monthly_bill').val(price);
        }
    });
});
</script>
@endpush