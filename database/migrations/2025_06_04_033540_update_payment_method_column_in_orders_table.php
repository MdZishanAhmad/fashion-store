<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // First drop the existing column
            $table->dropColumn('payment_method');
            
            // Then add it back as an enum
            $table->enum('payment_method', ['cash_on_delivery', 'khalti', 'esewa'])->after('is_paid');
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('payment_method');
            $table->text('payment_method')->after('is_paid');
        });
    }
};