@extends('layouts.admin')
@section('content')
    <h1>Network Links</h1>

    <a href="{{ route('admin.network-links.create') }}" class="btn btn-primary mb-3">Add Link</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>From Device</th>
                <th>To Device</th>
                <th>Status</th>
                <th>Bandwidth</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($networkLinks as $link)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $link->fromDevice->name ?? '' }}</td>
                    <td>{{ $link->toDevice->name ?? '' }}</td>
                    <td>{{ $link->status }}</td>
                    <td>{{ $link->bandwidth }}</td>
                    <td>
                        <a href="{{ route('admin.network-links.edit', $link->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.network-links.destroy', $link->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this link?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No links found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection