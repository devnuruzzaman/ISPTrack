<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SalarySheet;
use App\Models\Employee;

class SalarySheetController extends Controller
{
    public function index()
    {
        $salarySheets = SalarySheet::with('employee')->latest()->get();
        return view('admin.hr.salary_sheet.index', compact('salarySheets'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('admin.hr.salary_sheet.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer|min:2000|max:2100',
            'gross_salary' => 'nullable|numeric',
            'deductions' => 'nullable|numeric',
            'net_salary' => 'nullable|numeric',
            'status' => 'required|string',
        ]);

        SalarySheet::create([
            'employee_id' => $request->employee_id,
            'month' => $request->month,
            'year' => $request->year,
            'gross_salary' => $request->gross_salary,
            'deductions' => $request->deductions,
            'net_salary' => $request->net_salary,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.hr.salary_sheet.index')->with('success', 'Salary sheet created successfully!');
    }

    public function show($id)
    {
        $salarySheet = SalarySheet::with('employee')->findOrFail($id);
        return view('admin.hr.salary_sheet.show', compact('salarySheet'));
    }

    public function edit($id)
    {
        $salarySheet = SalarySheet::findOrFail($id);
        $employees = Employee::all();
        return view('admin.hr.salary_sheet.edit', compact('salarySheet', 'employees'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer|min:2000|max:2100',
            'gross_salary' => 'nullable|numeric',
            'deductions' => 'nullable|numeric',
            'net_salary' => 'nullable|numeric',
            'status' => 'required|string',
        ]);

        $salarySheet = SalarySheet::findOrFail($id);
        $salarySheet->update([
            'employee_id' => $request->employee_id,
            'month' => $request->month,
            'year' => $request->year,
            'gross_salary' => $request->gross_salary,
            'deductions' => $request->deductions,
            'net_salary' => $request->net_salary,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.hr.salary_sheet.index')->with('success', 'Salary sheet updated successfully!');
    }

    public function destroy($id)
    {
        $salarySheet = SalarySheet::findOrFail($id);
        $salarySheet->delete();
        return redirect()->route('admin.hr.salary_sheet.index')->with('success', 'Salary sheet deleted successfully!');
    }
}