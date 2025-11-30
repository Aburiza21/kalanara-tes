<?php

namespace Database\Seeders;

use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Transaction::factory()->has(TransactionItem::factory()->count(3))->create();
        $transaction = Transaction::factory()->create();
        TransactionItem::factory()->count(3)->for($transaction)->create();
    }
}
