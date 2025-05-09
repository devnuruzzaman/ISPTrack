@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Upazila Details</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>District</label>
                                <p>{{ $upazila->district->name }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name</label>
                                <p>{{ $upazila->name }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Code</label>
                        <p>{{ $upazila->code }}</p>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <span class="badge badge-{{ $upazila->is_active ? 'success' : 'danger' }}">
                            {{ $upazila->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>

                    <div class="form-group">
                        <a href="{{ route('admin.configuration.upazilas.edit', $upazila) }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('admin.configuration.upazilas.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection