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
        Schema::create('publication_sections', function (Blueprint $table) {
            $table->id();
            $table->string('title_id');
            $table->string('title_en');
            $table->integer('display_order')->default(0);
            $table->timestamps();
        });

        Schema::table('publications', function (Blueprint $table) {
            $table->foreignId('publication_section_id')->nullable()->after('id')->constrained('publication_sections')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publication_sections');
    }
};
