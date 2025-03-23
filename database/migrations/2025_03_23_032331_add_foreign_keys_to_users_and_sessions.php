<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('formationSessionID')->references('id')->on('formation_sessions')->onDelete('restrict');
        });

        Schema::table('formation_sessions', function (Blueprint $table) {
            $table->foreign('formateurID')->references('id')->on('users')->onDelete('restrict');
        });
    }

    public function down() {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['formationSessionID']);
        });

        Schema::table('formation_sessions', function (Blueprint $table) {
            $table->dropForeign(['formateurID']);
        });
    }
};