@extends('layouts.admin')
@section('content')
    <h1>Bulk Clients Import</h1>
    <form action="{{ route('admin.mikrotik.bulk.import.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Upload CSV/Excel File</label>
            <input type="file" name="import_file" class="form-control" accept=".csv,.xlsx" required>
        </div>
        <button type="submit" class="btn btn-success">Import</button>
    </form>
@endsection