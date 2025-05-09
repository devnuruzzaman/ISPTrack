@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-secondary text-white">
            <h3 class="card-title mb-0"><i class="fas fa-hand-holding-usd"></i> Manual Gateway Settings</h3>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <form action="{{ route('admin.billings.manual.update') }}" method="POST">
                @csrf
                <!-- Manual gateway fields -->
                <div class="form-group">
                    <label for="instructions">Instructions</label>
                    <textarea id="instructions" name="instructions" class="form-control" required>{{ old('instructions', $settings->instructions ?? '') }}</textarea>
                </div>
                <button class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection