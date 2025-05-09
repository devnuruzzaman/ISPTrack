@extends('layouts.admin')
@section('content')
    <h1>Network Devices</h1>

    <a href="{{ route('admin.network-devices.create') }}" class="btn btn-primary mb-3">Add Device</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>IP</th>
                <th>Type</th>
                <th>Location</th>
                <th>Info</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($networkDevices as $device)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $device->name }}</td>
                    <td>{{ $device->ip }}</td>
                    <td>{{ $device->type }}</td>
                    <td>{{ $device->location }}</td>
                    <td>{{ $device->info }}</td>
                    <td>
                        <a href="{{ route('admin.network-devices.edit', $device->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.network-devices.destroy', $device->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this device?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No devices found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection