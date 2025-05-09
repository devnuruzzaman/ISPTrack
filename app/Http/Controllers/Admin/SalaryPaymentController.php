<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SalaryPaymentController extends Controller
{
    public function index()
    {
        // $salaryPayments = SalaryPayment::all();
        return view('admin.hr.salary_payment.index'); //, compact('salaryPayments')
    }

    public function create() { }
    public function store(Request $request)
    {
        // SalaryPayment::create($request->all());
        return back()->with('success', 'Salary payment saved!');
    }
    public function show($id) { }
    public function edit($id) { }
    public function update(Request $request, $id) { }
    public function destroy($id) { }
}