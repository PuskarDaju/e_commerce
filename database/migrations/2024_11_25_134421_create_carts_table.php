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
        Schema::create('carts', function (Blueprint $table) {
            $table->unsignedBigInteger('cart_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('product_id');
            $table->bigInteger('quantity');
            

            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('CASCADE');
            $table->foreign('cart_id')->references('cart_id')->on('maincart')->onDelete('CASCADE');

            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
