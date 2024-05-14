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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('metaTitle');
            $table->string('image');
            $table->text('description');
            $table->longText('metaDescription');
            $table->string('slug');
            $table->enum('status',['active','inactive'])->default('inactive');
            $table->unsignedInteger('view')->default(0);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('category_post_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('category_post_id')->references('id')->on('category_posts');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
