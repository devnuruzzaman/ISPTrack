<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PayrollReportController extends Controller
{
    public function index()
    {
        // $reports = PayrollReport::all();
        return view('admin.hr.payroll_report.index'); //, compact('reports')
    }

    public function create() { }
    public function store(Request $request) { }
    public function show($id) { }
    public function edit($id) { }
    public function update(Request $request, $id) { }
    public function destroy($id) { }
}