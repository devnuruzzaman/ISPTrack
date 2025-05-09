<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryPayment extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'salary_sheet_id', 'amount', 'payment_date', 'payment_method'];
}