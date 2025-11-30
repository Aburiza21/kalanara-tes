<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /** @use HasFactory<\Database\Factories\TransactionFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'invoice',
        'total',
        'pay',
        'return',
    ];

    // Begin Relasi Eloquent

    // User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Transaction Items
    public function items()
    {
        return $this->hasMany(TransactionItem::class);
    }
}
