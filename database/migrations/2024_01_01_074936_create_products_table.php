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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable(); // Use text for longer descriptions
            $table->unsignedBigInteger('category_id')->nullable(); // Aligned with bigInt
            $table->string('image_url');
            $table->string('brand');

            $table->string('color');
            $table->string('size');
            $table->decimal('price', 10, 2);
            $table->integer('stock_quantity')->default(0);
            $table->timestamps();
        
            // Define foreign key with cascade deletion
            $table->foreign('category_id')
                  ->references('cid')
                  ->on('categories')
                  ->onDelete('cascade');
        });
      
        
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
