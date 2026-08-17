<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Exécute la migration.
     */
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id('id_service'); // clé primaire auto-incrémentée
            $table->string('nom_service', 150);
            $table->string('code_service', 50)->unique();
            // $table->timestamps(); // Décommente si tu veux created_at / updated_at
        });
    }

    /**
     * Annule la migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
