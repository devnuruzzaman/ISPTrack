@extends('layouts.admin')
@section('content')
    <h1>Add Mikrotik Server</h1>
    <form action="{{ route('admin.mikrotik.servers.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>IP Address</label>
            <input type="text" name="ip" class="form-control" required>
        </div>
        <div class="form-group">
            <label>API Port</label>
            <input type="number" name="api_port" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
    </form>
@endsection