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
        Schema::table('certificats', function (Blueprint $table) {
            $table->foreignId('formationSessionID')
                ->constrained('formation_sessions')
                ->onDelete('restrict')
                ->after('statut');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('certificats', function (Blueprint $table) {
            $table->dropForeign(['formationSessionID']);
            $table->dropColumn('formationSessionID');
        });
    }
};