<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionItem extends Model
{
    /** @use HasFactory<\Database\Factories\TransactionItemFactory> */
    use HasFactory;
    protected $fillable = [
        'transaction_id',
        'product_id',
        'price',
        'quantity',
    ];

    // Begin Relasi Eloquent

    // Transaction
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    // Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
