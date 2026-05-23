<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('divisions', function (Blueprint $table) {
            $table->id();
            $table->string('name_id', 100);
            $table->string('name_en', 100);
            $table->string('slug', 100)->unique();
            $table->text('description_id')->nullable();
            $table->text('description_en')->nullable();
            $table->integer('display_order')->default(0);
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('division_id')->constrained()->onDelete('cascade');
            $table->string('title_id', 200);
            $table->string('title_en', 200);
            $table->string('slug', 200)->unique();
            $table->text('short_description_id')->nullable();
            $table->text('short_description_en')->nullable();
            $table->longText('description_id')->nullable();
            $table->longText('description_en')->nullable();
            $table->string('icon', 50)->nullable();
            $table->string('featured_image_url')->nullable();
            $table->text('featured_image_alt')->nullable();
            $table->json('carousel_images')->nullable();
            $table->boolean('active')->default(true);
            $table->integer('display_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('programs');
        Schema::dropIfExists('divisions');
    }
};