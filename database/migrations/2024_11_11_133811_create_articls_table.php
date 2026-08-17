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
        Schema::create('articls', function (Blueprint $table) {
            $table->comment('TRIAL');
            $table->integer('id_articl')->nullable()->comment('TRIAL');
            $table->longText('articl')->nullable()->comment('TRIAL');
            $table->integer('résultat')->nullable()->comment('TRIAL');
            $table->char('trial739', 1)->nullable()->comment('TRIAL');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articls');
    }
};
