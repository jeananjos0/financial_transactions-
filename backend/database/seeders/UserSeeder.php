<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //Criando adm
        DB::table('users')->insert([
            'role_id' => 1,
            'fullname' => 'admin',
            'cpf_cnpj' => '222.456.789-1',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'wallet_balance' => 0,
        ]);


        //Criando 5 usuários
        for ($i = 1; $i <= 5; $i++) {
            DB::table('users')->insert([
                'role_id' => 2,
                'fullname' => 'Usuário ' . $i,
                'cpf_cnpj' => '564.322.789-0' . $i,
                'email' => 'usuario' . $i . '@gmail.com',
                'password' => Hash::make('123456'),
                'wallet_balance' => 1000,
            ]);
        }

        //Criando 10 Logista
        for ($i = 1; $i <= 5; $i++) {
            DB::table('users')->insert([
                'role_id' => 3,
                'fullname' => 'Logista ' . $i,
                'cpf_cnpj' => '985.333.789-0' . $i,
                'email' => 'logista' . $i . '@gmail.com',
                'password' => Hash::make('123456'),
                'wallet_balance' => 0,
            ]);
        }

    }
}
