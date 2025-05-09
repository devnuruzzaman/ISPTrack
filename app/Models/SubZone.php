<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubZone extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'zone_id',
        'name',
        'code',
        'description',
        'is_active'
    ];

    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    public function boxes()
    {
        return $this->hasMany(Box::class);
    }
}