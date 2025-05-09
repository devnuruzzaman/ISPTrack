<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'template_id',
        'client_id',
        'phone_number',
        'message',
        'status',
        'gateway',
        'message_id',
        'sent_at',
        'delivered_at',
        'error_message',
        'response_data',
        'created_by'
    ];

    protected $casts = [
        'response_data' => 'array',
        'sent_at' => 'datetime',
        'delivered_at' => 'datetime'
    ];

    // Relations
    public function template()
    {
        return $this->belongsTo(SmsTemplate::class, 'template_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}