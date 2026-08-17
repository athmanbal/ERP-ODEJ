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
        Schema::create('etat_fonctionaire', function (Blueprint $table) {
            $table->comment('TRIAL');
            $table->integer('id_fonctionaire')->nullable()->comment('TRIAL');
            $table->dateTime('date_d')->nullable()->comment('TRIAL');
            $table->dateTime('date_f')->nullable()->comment('TRIAL');
            $table->string('motif')->nullable()->comment('TRIAL');
            $table->char('trial739', 1)->nullable()->comment('TRIAL');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etat_fonctionaire');
    }
};
