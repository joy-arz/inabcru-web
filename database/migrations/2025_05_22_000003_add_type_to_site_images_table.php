<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_images', function (Blueprint $table) {
            $table->string('type', 20)->default('image')->after('category');
        });
    }

    public function down(): void
    {
        Schema::table('site_images', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};