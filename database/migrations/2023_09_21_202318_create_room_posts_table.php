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
        Schema::create('room_posts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->integer('price');
            $table->string('address');
            $table->string('address_full');
            $table->integer('acreage');
            $table->integer('empty_room');
            $table->text('description');
            $table->string('image');
            $table->enum('status', ['pendding', 'accept', 'cancel'])->default('pendding');
            $table->enum('managing', ['yes', 'no'])->default('no');
            $table->integer('ward_id');
            $table->integer('district_id');
            $table->integer('city_id');
            $table->string('fullname');
            $table->string('phone');
            $table->string('email');
            $table->string('zalo')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('service_id')->nullable();
            $table->unsignedBigInteger('category_room_id');
            $table->foreign('category_room_id')->references('id')->on('category_rooms')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->dateTime('time_end')->nullable();
            $table->dateTime('time_start')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table('room_posts', function (Blueprint $table) {
            $table->foreign('service_id')->references('id')->on('services');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_posts');
    }
};
