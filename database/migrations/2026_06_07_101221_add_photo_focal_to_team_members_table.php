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
        Schema::table('team_members', function (Blueprint $table) {
            $table->decimal('photo_focal_x', 5, 2)->nullable()->default(50)->after('photo_position');
            $table->decimal('photo_focal_y', 5, 2)->nullable()->default(50)->after('photo_focal_x');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('team_members', function (Blueprint $table) {
            $table->dropColumn(['photo_focal_x', 'photo_focal_y']);
        });
    }
};
