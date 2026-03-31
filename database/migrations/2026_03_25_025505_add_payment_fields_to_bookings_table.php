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
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('payment_token')->nullable()->after('total_price');
            $table->string('payment_url')->nullable()->after('payment_token');
            $table->string('order_id')->nullable()->after('payment_url');
            $table->string('payment_status')->default('pending')->after('order_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn([
                'payment_token',
                'payment_url',
                'order_id',
                'payment_status'
            ]);
        });
    }
};
