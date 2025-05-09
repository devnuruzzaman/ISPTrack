<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NetworkLink extends Model
{
    use HasFactory;

    // Fillable fields
    protected $fillable = [
        'from_device_id',
        'to_device_id',
        'status',
        'bandwidth'
    ];

    // From Device (লিঙ্কের শুরু)
    public function fromDevice()
    {
        return $this->belongsTo(NetworkDevice::class, 'from_device_id');
    }

    // To Device (লিঙ্কের শেষ)
    public function toDevice()
    {
        return $this->belongsTo(NetworkDevice::class, 'to_device_id');
    }
}