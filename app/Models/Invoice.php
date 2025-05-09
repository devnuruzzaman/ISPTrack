<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'client_id',
        'amount',
        'due_date',
        'status',
        'description',
        'paid_amount',
        'paid_at'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'paid_amount' => 'decimal:2',
        'due_date' => 'date',
        'paid_at' => 'datetime'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function getDueAmountAttribute()
    {
        return $this->amount - ($this->paid_amount ?? 0);
    }

    public function markAsPaid()
    {
        $this->update([
            'status' => 'paid',
            'paid_amount' => $this->amount,
            'paid_at' => now()
        ]);
    }
}