<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Criando 20 transações
        for ($i = 1; $i <= 20; $i++) {
            $sender_id = rand(1, 10);
            $recipient_id = rand(1, 10);
            $amount = rand(1, 10) * 100;

            DB::table('transactions')->insert([
                'sender_id' => $sender_id,
                'recipient_id' => $recipient_id,
                'amount' => $amount,
                'transaction_date' => now(),
                'status' => 'pending',
            ]);
        }
    }
}
