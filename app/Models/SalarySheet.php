<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalarySheet extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'month', 'year', 'gross_salary', 'deductions', 'net_salary', 'status' , 'created_at', 'updated_at'];

    public function employee()
{
    return $this->belongsTo(\App\Models\Employee::class, 'employee_id');
}
}