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
        Schema::create('formation_sessions', function (Blueprint $table) {
            $table->id();
            $table->date('dateDebut');
            $table->date('dateFin');
            $table->string('statut');
            $table->unsignedInteger('capacite');
            $table->unsignedInteger('nombreInscrits')->default(0);
            
            $table->foreignId('formationID')->constrained('formations')->onDelete('restrict');
            $table->unsignedBigInteger('formateurID');
        
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formationSessions');
    }
};