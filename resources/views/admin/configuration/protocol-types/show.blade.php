@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Protocol Type Details</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name</label>
                                <p>{{ $protocolType->name }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Code</label>
                                <p>{{ $protocolType->code }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <p>{{ $protocolType->description }}</p>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <span class="badge badge-{{ $protocolType->is_active ? 'success' : 'danger' }}">
                            {{ $protocolType->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>

                    <div class="form-group">
                        <a href="{{ route('admin.configuration.protocol-types.edit', $protocolType) }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('admin.configuration.protocol-types.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection