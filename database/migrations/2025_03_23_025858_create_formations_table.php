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
        Schema::create('formations', function (Blueprint $table) {
            $table->id();
            $table->string('nomFormation');
            $table->string('description');
            $table->string('niveau');
            $table->string('image');
            $table->unsignedBigInteger('duree');
            
            $table->foreignId('sousCategorieID')->constrained('sous_categories')->onDelete('restrict');
        
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formations');
    }
};