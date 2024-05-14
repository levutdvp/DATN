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
        Schema::create('category_posts', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->enum('status',['active','inactive'])->default('inactive');
            $table->string('slug');
            $table->text('description')->nullable();;
            $table->timestamps();
            $table->softDeletes();
        });
        DB::table('category_posts')->insert([
            'name' => 'uncategorized',
            'status' => 'active',
            'slug' => 'uncategorized',
            'description' => 'Danh mục bài viết mặc định',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_posts');
    }
};
