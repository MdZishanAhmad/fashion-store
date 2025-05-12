<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            
            // Use unsignedBigInteger for foreign keys
            $table->unsignedBigInteger('productId');
            $table->unsignedBigInteger('customerId');
            
            // Default to 1 quantity since 0 wouldn't make sense in cart
            $table->unsignedInteger('quantity')->default(1);
            
            $table->timestamps();
            
            // Add foreign key constraints
            $table->foreign('productId')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('customerId')->references('id')->on('users')->onDelete('cascade');
            
            // Add unique constraint to prevent duplicate items
            $table->unique(['productId', 'customerId']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};