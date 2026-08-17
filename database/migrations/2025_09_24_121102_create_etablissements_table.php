<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('etablissements', function (Blueprint $table) {
            $table->id('id_etablissement'); // clé primaire auto-incrémentée
            $table->string('nom_etablissement');
            $table->string('type_etablissement');
            $table->string('address_etablissement')->nullable();
            $table->string('telFax_etablissement')->nullable();
            $table->string('mail_etablissement')->nullable();
            $table->timestamps(); // si tu veux created_at et updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('etablissements');
    }
};
