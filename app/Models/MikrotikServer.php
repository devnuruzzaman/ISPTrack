<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MikrotikServer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'ip', 'api_port', 'username', 'password', 'description'
    ];
}