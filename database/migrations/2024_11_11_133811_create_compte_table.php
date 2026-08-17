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
        Schema::create('compte', function (Blueprint $table) {
            $table->comment('TRIAL');
            $table->double('id_compte', null, 0)->nullable()->unique('primarykey')->comment('TRIAL');
            $table->integer('n_compte')->nullable()->comment('TRIAL');
            $table->string('id_typecompte')->nullable()->comment('TRIAL');
            $table->char('trial739', 1)->nullable()->comment('TRIAL');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compte');
    }
};
