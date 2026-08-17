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
        Schema::create('rubrique', function (Blueprint $table) {
            $table->comment('TRIAL');
            $table->double('id_rubrique', null, 0)->nullable()->unique('idx_id_rubrique')->comment('TRIAL');
            $table->string('coderubrique')->nullable()->index('idx_coderubrique')->comment('TRIAL');
            $table->string('titre')->nullable()->comment('TRIAL');
            $table->string('description')->nullable()->comment('TRIAL');
            $table->string('typevaleur')->nullable()->comment('TRIAL');
            $table->string('formule')->nullable()->comment('TRIAL');
            $table->double('valeur', null, 0)->nullable()->comment('TRIAL');
            $table->string('naturerubrique')->nullable()->comment('TRIAL');
            $table->char('trial746', 1)->nullable()->comment('TRIAL');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rubrique');
    }
};
