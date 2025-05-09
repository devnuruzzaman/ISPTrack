<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SmsTemplate extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'content',
        'parameters',
        'type',
        'is_active',
        'description',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'parameters' => 'array',
        'is_active' => 'boolean'
    ];

    // Relations
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function smsLogs()
    {
        return $this->hasMany(SmsLog::class, 'template_id');
    }
}