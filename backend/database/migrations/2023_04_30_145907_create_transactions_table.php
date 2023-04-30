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
        if (!Schema::hasTable('transactions')) {

            Schema::create('transactions', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('sender_id');
                $table->unsignedInteger('recipient_id');
                $table->decimal('amount', 8, 2);
                $table->timestamp('transaction_date')->default(now());
                $table->string('status')->default('pending');
                $table->timestamps();
            
                $table->foreign('sender_id')->references('id')->on('users');
                $table->foreign('recipient_id')->references('id')->on('users');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
