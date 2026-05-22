<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('team_members', function (Blueprint $table) {
            $table->string('division', 50)->nullable()->after('linkedin_url');
            $table->string('role', 100)->nullable()->after('division');
            $table->text('bio')->nullable()->after('bio_en');
        });
    }

    public function down(): void
    {
        Schema::table('team_members', function (Blueprint $table) {
            $table->dropColumn(['division', 'role', 'bio']);
        });
    }
};