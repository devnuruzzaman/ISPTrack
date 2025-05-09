@extends('layouts.admin')
@section('content')
    <h1>Mikrotik Servers</h1>
    <a href="{{ route('admin.mikrotik.servers.create') }}" class="btn btn-primary">Add Server</a>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>IP</th>
                <th>API Port</th>
                <th>Username</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($servers as $server)
                <tr>
                    <td>{{ $server->name }}</td>
                    <td>{{ $server->ip }}</td>
                    <td>{{ $server->api_port }}</td>
                    <td>{{ $server->username }}</td>
                    <td>
                        <a href="{{ route('admin.mikrotik.servers.edit', $server->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.mikrotik.servers.destroy', $server->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection