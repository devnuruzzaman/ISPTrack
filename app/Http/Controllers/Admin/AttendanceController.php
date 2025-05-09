<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    // AttendanceController.php

public function index()
{
    $attendances = Attendance::with('employee')->latest()->get();
    return view('admin.hr.attendance.index', compact('attendances'));
}

public function create()
{
    $employees = \App\Models\Employee::all();
    return view('admin.hr.attendance.create', compact('employees'));
}

public function store(Request $request)
{
    $request->validate([
        'employee_id' => 'required|exists:employees,id',
        'date' => 'required|date',
        'status' => 'required|string',
    ]);
    Attendance::create($request->all());
    return redirect()->route('admin.hr.attendance.index')->with('success', 'Attendance added successfully!');
}

public function edit($id)
{
    $attendance = Attendance::findOrFail($id);
    $employees = \App\Models\Employee::all();
    return view('admin.hr.attendance.edit', compact('attendance', 'employees'));
}
}
