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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('room_post_id')->nullable();
            $table->integer('point');
            $table->integer('point_persent')->nullable();
            $table->integer('price_promotion')->nullable();
            $table->integer('vnpay_code')->nullable();
            $table->integer('coupon_id')->nullable();
            $table->enum('payment_method', ['transfer', 'vnpay'])->nullable();
            $table->enum('action', ['import', 'export']);
            $table->string('verification')->nullable();
            $table->enum('status', ['pending', 'accept', 'cancel'])->default('pending');
            $table->string('reason')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('room_post_id')->references('id')->on('room_posts');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
