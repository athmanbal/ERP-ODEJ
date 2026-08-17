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
    Schema::create('categoriefonctionnaires', function (Blueprint $table) {
        $table->id('Id_CategorieFonctionnaire'); // clé primaire
        $table->string('Nom_CategorieFonctionnaire');
        $table->boolean('Display')->default(1);
        $table->timestamps(); // created_at et updated_at
    });
}

public function down(): void
{
    Schema::dropIfExists('categoriefonctionnaires');
}
};
