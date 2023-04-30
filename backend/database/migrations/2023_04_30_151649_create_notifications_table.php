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
        if (!Schema::hasTable('notifications')) {
            Schema::create('notifications', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('user_id');
                $table->unsignedInteger('transaction_id');
                $table->string('message');
                $table->timestamp('sent_at')->nullable();
                $table->timestamps();
            
                $table->foreign('user_id')->references('id')->on('users');
                $table->foreign('transaction_id')->references('id')->on('transactions');
            });
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
