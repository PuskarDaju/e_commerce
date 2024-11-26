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
        Schema::create('orders', function (Blueprint $table) {
            $table->id('oid');
            $table->unsignedBigInteger('user_id');
            $table->string('order_status')->default('pending');
            $table->decimal('total_amount');
            $table->string('shipping_address')->nullable();
            $table->string('billig_address')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_status')->nullable();
        
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
