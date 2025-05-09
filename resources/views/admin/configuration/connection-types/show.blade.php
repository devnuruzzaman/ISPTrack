@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Connection Type Details</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name</label>
                                <p>{{ $connectionType->name }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Code</label>
                                <p>{{ $connectionType->code }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <p>{{ $connectionType->description }}</p>
                    </div>

                    <div class="form-group">
                        <label>Discount Percentage</label>
                        <p>{{ $connectionType->discount_percentage }}%</p>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <span class="badge badge-{{ $connectionType->is_active ? 'success' : 'danger' }}">
                            {{ $connectionType->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>

                    <div class="form-group">
                        <a href="{{ route('admin.configuration.connection-types.edit', $connectionType) }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('admin.configuration.connection-types.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection