<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayrollReport extends Model
{
    use HasFactory;

    protected $fillable = ['month', 'year', 'total_salary', 'total_paid', 'remarks'];
}