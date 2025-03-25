<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('reponses', function (Blueprint $table) {
            $table->boolean('statut')->default(0)->change();
        });
    }

    public function down()
    {
        Schema::table('reponses', function (Blueprint $table) {
            $table->string('statut')->change();
        });
    }
};