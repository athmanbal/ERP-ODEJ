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
    Schema::table('fonctionnaires', function (Blueprint $table) {
        $table->foreign('id_etablissement')
              ->references('id_etablissement')
              ->on('etablissements')
              ->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::table('fonctionnaires', function (Blueprint $table) {
        $table->dropForeign(['id_etablissement']);
    });
}

};
