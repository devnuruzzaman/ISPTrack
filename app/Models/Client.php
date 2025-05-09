<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $guard = 'client';

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'package_id',
        'connection_id',
        'monthly_bill',
        'billing_cycle',
        'due_date',
        'is_active',
        'notes',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'due_date' => 'date',
        'monthly_bill' => 'decimal:2',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function smsLogs()
    {
        return $this->hasMany(SmsLog::class);
    }

    public function clientType()
{
    return $this->belongsTo(\App\Models\ClientType::class, 'client_type_id');
}
}
