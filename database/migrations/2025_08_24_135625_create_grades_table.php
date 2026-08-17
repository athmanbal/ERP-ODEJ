<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->id('id_grade'); // clé primaire
            $table->string('code_grade', 50)->unique();
            $table->string('nom_grade', 150);
            $table->integer('bonification')->default(0);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};
