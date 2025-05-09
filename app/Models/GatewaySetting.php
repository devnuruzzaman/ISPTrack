<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GatewaySetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'gateway', // e.g. bkash, nagad, rocket, manual, online
        'settings', // json
    ];

    protected $casts = [
        'settings' => 'array',
    ];
}