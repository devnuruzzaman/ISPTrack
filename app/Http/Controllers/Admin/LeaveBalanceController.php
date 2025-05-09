<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LeaveBalanceController extends Controller
{
    public function index()
    {
        // Logic for fetching leave balances
        $leaveBalances = []; // Fetch leave balance data

        return view('admin.LeaveManagement.leave_balance.index', compact('leaveBalances'));
    }
}
