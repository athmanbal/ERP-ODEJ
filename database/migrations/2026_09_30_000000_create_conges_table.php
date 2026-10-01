<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('conges', function (Blueprint $table) {
            $table->id('id_conge');
            $table->double('id_fonctionnaire');
            $table->enum('type_conge', ['annuel', 'maladie', 'exceptionnel', 'maternite', 'sans_solde'])
                  ->default('annuel');
            $table->date('date_depart');
            $table->date('date_retour');
            $table->unsignedInteger('nombre_jours')->nullable();
            $table->string('motif')->nullable();
            $table->enum('statut', ['en_attente', 'approuve', 'refuse'])->default('en_attente');
            $table->timestamps();

            $table->foreign('id_fonctionnaire')
                  ->references('id_fonctionnaire')->on('fonctionnaires')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('conges');
    }
};
