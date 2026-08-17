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
        Schema::create('alocation', function (Blueprint $table) {
            $table->comment('TRIAL');
            $table->integer('id_enfant')->nullable()->unique('primarykey')->comment('TRIAL');
            $table->string('nom_enfant')->nullable()->comment('TRIAL');
            $table->string('prenom_enfant')->nullable()->comment('TRIAL');
            $table->dateTime('date_naissance')->nullable()->comment('TRIAL');
            $table->string('scolarise')->nullable()->comment('TRIAL');
            $table->double('id_fonctionnaire', null, 0)->nullable()->comment('TRIAL');
            $table->char('trial739', 1)->nullable()->comment('TRIAL');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alocation');
    }
};
