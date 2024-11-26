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
        Schema::create('payments', function (Blueprint $table) {
            $table->id('pid');
            $table->unsignedBigInteger('order_id');
            $table->decimal('amount');
            $table->string('method');
            $table->string('status');
            $table->string('transaction_id');
            $table->timestamps();
            $table->foreign('order_id')->references('oid')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
