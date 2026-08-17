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
    Schema::create('comptes', function (Blueprint $table) {
        $table->id('Id_Compte'); // clé primaire auto-incrémentée
        $table->bigInteger('N_Compte'); // numéro de compte (grand entier)
        $table->string('Id_TypeCompte'); // CCP, CPA, etc.
        $table->timestamps(); // si tu veux created_at et updated_at
    });
}

public function down(): void
{
    Schema::dropIfExists('comptes');
}
};
