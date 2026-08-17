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
        Schema::create('grille', function (Blueprint $table) {
            $table->comment('TRIAL');
            $table->double('niveau', null, 0)->nullable()->unique('idx_niveau')->comment('TRIAL');
            $table->double('valeur_indiciere', null, 0)->nullable()->comment('TRIAL');
            $table->double('1', null, 0)->nullable()->comment('TRIAL');
            $table->double('2', null, 0)->nullable()->comment('TRIAL');
            $table->double('3', null, 0)->nullable()->comment('TRIAL');
            $table->double('4', null, 0)->nullable()->comment('TRIAL');
            $table->double('5', null, 0)->nullable()->comment('TRIAL');
            $table->double('6', null, 0)->nullable()->comment('TRIAL');
            $table->double('7', null, 0)->nullable()->comment('TRIAL');
            $table->double('8', null, 0)->nullable()->comment('TRIAL');
            $table->double('9', null, 0)->nullable()->comment('TRIAL');
            $table->double('10', null, 0)->nullable()->comment('TRIAL');
            $table->double('11', null, 0)->nullable()->comment('TRIAL');
            $table->double('12', null, 0)->nullable()->comment('TRIAL');
            $table->char('trial739', 1)->nullable()->comment('TRIAL');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grille');
    }
};
