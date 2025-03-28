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
        Schema::create('session_progressions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidatID')->constrained('users')->onDelete('cascade');
            $table->foreignId('formationSessionID')->constrained('formation_sessions')->onDelete('cascade');
            $table->unsignedInteger('progression')->default(0);
            $table->json('courIDs')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('session_progressions');
    }
};
