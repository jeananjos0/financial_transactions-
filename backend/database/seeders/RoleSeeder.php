<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Criando 3 nível de permissão
        DB::table('roles')->insert([
            'description'=>'Administrador',
        ]);

        DB::table('roles')->insert([
            'description'=>'Usuário',
        ]);

        DB::table('roles')->insert([
            'description'=>'Lojista',
        ]);

    }
}
