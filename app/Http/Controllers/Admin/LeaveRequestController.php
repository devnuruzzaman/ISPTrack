<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\LeaveType;


class LeaveRequestController extends Controller
{
    public function index()
    {
        $leaveRequests = LeaveRequest::with(['employee', 'leaveType'])->orderByDesc('created_at')->get();
        return view('admin.LeaveManagement.leave_requests.index', compact('leaveRequests'));
    }

    public function create()
    {
         // Fetch employees and leave types from the database
         $employees = Employee::all();
         $leaveTypes = LeaveType::all();

         // Pass the data to the view
         return view('admin.LeaveManagement.leave_requests.create', compact('employees', 'leaveTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'leave_type_id' => 'required|exists:leave_types,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string',
        ]);

        LeaveRequest::create($request->all());

        return redirect()->route('admin.LeaveManagement.leave_requests.index')->with('success', 'Leave request created successfully.');
    }

    public function approve($id)
    {
        $leave = LeaveRequest::findOrFail($id);
        $leave->status = 'Approved';
        $leave->save();

        return back()->with('success', 'Leave approved!');
    }

    public function reject($id)
    {
        $leave = LeaveRequest::findOrFail($id);
        $leave->status = 'Rejected';
        $leave->save();

        return back()->with('success', 'Leave rejected!');
    }
}
