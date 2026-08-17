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
        Schema::table('media', function (Blueprint $table) {
            $table->date('dateDefie')->nullable(); // Colonne pour la date
            $table->string('NumDocs')->nullable(); // Colonne pour le numéro de document
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('media', function (Blueprint $table) {
            $table->dropColumn('dateDefie');
            $table->dropColumn('NumDocs');
        });
    }
};
