<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title_id');
            $table->string('title_en');
            $table->text('content_id')->nullable();
            $table->text('content_en')->nullable();
            $table->string('category')->default('news');
            $table->string('featured_image_url')->nullable();
            $table->string('slug')->nullable();
            $table->string('meta_location_id')->nullable();
            $table->string('meta_location_en')->nullable();
            $table->boolean('published')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};