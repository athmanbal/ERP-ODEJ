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
        Schema::create('fonction', function (Blueprint $table) {
            $table->comment('TRIAL');
            $table->double('id_fonction', null, 0)->nullable()->unique('primarykey')->comment('TRIAL');
            $table->string('section')->nullable()->comment('TRIAL');
            $table->double('taux_prime', null, 0)->nullable()->comment('TRIAL');
            $table->string('nom_fonction')->nullable()->comment('TRIAL');
            $table->integer('code_fonction')->nullable()->index('code fonction')->comment('TRIAL');
            $table->integer('niveau')->nullable()->comment('TRIAL');
            $table->integer('valeur_indiciere')->nullable()->comment('TRIAL');
            $table->string('id_corps')->nullable()->index('corpsfonction')->comment('TRIAL');
            $table->char('trial739', 1)->nullable()->comment('TRIAL');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fonction');
    }
};
