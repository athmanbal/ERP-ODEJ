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
        Schema::create('retenus', function (Blueprint $table) {
            $table->comment('TRIAL');
            $table->integer('id_fonctionnaire')->nullable()->comment('TRIAL');
            $table->string('anneeretenu')->nullable()->comment('TRIAL');
            $table->string('moisretenu')->nullable()->comment('TRIAL');
            $table->integer('nbrjour')->nullable()->comment('TRIAL');
            $table->char('trial743', 1)->nullable()->comment('TRIAL');

            $table->unique(['id_fonctionnaire', 'anneeretenu', 'moisretenu'], 'primarykey');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retenus');
    }
};
