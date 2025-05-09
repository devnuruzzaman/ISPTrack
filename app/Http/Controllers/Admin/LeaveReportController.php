<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LeaveReportController extends Controller
{
    public function index()
    {
        // Logic for fetching and preparing leave reports
        $leaveReports = []; // Fetch leave reports data

        return view('admin.LeaveManagement.leave_reports.index', compact('leaveReports'));
    }
}
