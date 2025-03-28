<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('booking_coupons', function (Blueprint $table) {
        $table->foreignId('booking_id')->constrained()->onDelete('cascade');
        $table->foreignId('coupon_id')->constrained()->onDelete('cascade');
        $table->primary(['booking_id', 'coupon_id']);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_coupons');
    }
};
