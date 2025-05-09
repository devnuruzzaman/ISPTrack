@extends('layouts.admin')
@section('content')
    <h1>Import From Mikrotik</h1>
    <form action="{{ route('admin.mikrotik.import.mikrotik') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Select Server</label>
            <select name="server_id" class="form-control" required>
                @foreach($servers as $server)
                    <option value="{{ $server->id }}">{{ $server->name }} ({{ $server->ip }})</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Import Clients</button>
    </form>
@endsection