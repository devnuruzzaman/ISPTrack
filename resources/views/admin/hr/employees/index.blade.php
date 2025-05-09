@extends('layouts.admin')
@section('content')
    <h1>Employee List</h1>
    <a href="{{ route('admin.hr.employees.create') }}" class="btn btn-primary mb-3">Add New Employee</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Department</th>
                <th>Designation</th>
                <th>Joining Date</th>
                <th>Salary</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($employees as $employee)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->phone }}</td>
                    <td>{{ optional($employee->department)->name }}</td>
                    <td>{{ optional($employee->designation)->name }}</td>
                    <td>{{ $employee->joining_date }}</td>
                    <td>{{ $employee->salary }}</td>
                    <td>
                        <a href="{{ route('admin.hr.employees.edit', $employee->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.hr.employees.destroy', $employee->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">No employees found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection