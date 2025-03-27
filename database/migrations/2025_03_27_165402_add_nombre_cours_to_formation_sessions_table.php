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
        Schema::table('formation_sessions', function (Blueprint $table) {
            $table->unsignedInteger('nombreCours')->default(0)->after('nombreInscrits');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('formation_sessions', function (Blueprint $table) {
            $table->dropColumn('nombreCours');
        });
    }
};