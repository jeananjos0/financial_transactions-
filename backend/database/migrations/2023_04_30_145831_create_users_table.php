<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('role_id');
                $table->string('fullname');
                $table->string('cpf_cnpj')->unique();
                $table->string('email')->unique();
                $table->string('password');
                $table->string('active')->default(1);
                $table->decimal('wallet_balance', 8, 2)->default(0);
                $table->timestamps();

                $table->foreign('role_id')->references('id')->on('roles');
            });


        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
