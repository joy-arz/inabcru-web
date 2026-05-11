<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('publications', function (Blueprint $table) {
            $table->id();
            $table->string('title_id');
            $table->string('title_en');
            $table->text('abstract_id')->nullable();
            $table->text('abstract_en')->nullable();
            $table->string('journal')->nullable();
            $table->integer('year')->nullable();
            $table->string('doi')->nullable();
            $table->string('cover_image_url')->nullable();
            $table->json('content_blocks')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('publications');
    }
};