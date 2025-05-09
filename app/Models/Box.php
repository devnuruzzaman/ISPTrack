<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Box extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'sub_zone_id',
        'name',
        'code',
        'location',
        'capacity',
        'description',
        'is_active'
    ];

    public function subZone()
    {
        return $this->belongsTo(SubZone::class);
    }

    public function clients()
    {
        return $this->hasMany(Client::class);
    }
}