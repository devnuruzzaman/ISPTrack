<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NetworkDevice extends Model
{
    use HasFactory;

    // Fillable fields
    protected $fillable = [
        'name',
        'ip',
        'type',
        'location',
        'info'
    ];

    // From Links (এই ডিভাইস থেকে outgoing লিঙ্ক)
    public function fromLinks()
    {
        return $this->hasMany(NetworkLink::class, 'from_device_id');
    }

    // To Links (এই ডিভাইসে incoming লিঙ্ক)
    public function toLinks()
    {
        return $this->hasMany(NetworkLink::class, 'to_device_id');
    }
}