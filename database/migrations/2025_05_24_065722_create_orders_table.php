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
            $table->id();
            $table->unsignedInteger('customerId');
            $table->string('order_number');
            $table->enum('status', ['pending', 'accepted','reject','delivered'])->default('pending');
            $table->decimal('grand_total',10,2);
            $table->integer('item_count');
            $table->boolean('is_paid')->default(false);
            $table->text('payment_method', ['cash_on_delivery', 'khalti','esewa']);
            $table->timestamps();
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
