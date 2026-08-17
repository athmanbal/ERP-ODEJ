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
        Schema::create('utilisateur', function (Blueprint $table) {
            $table->comment('TRIAL');
            $table->double('champ1', null, 0)->nullable()->unique('primarykey')->comment('TRIAL');
            $table->string('champ2')->nullable()->comment('TRIAL');
            $table->string('champ3')->nullable()->comment('TRIAL');
            $table->string('champ4')->nullable()->comment('TRIAL');
            $table->string('champ5')->nullable()->comment('TRIAL');
            $table->char('trial746', 1)->nullable()->comment('TRIAL');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utilisateur');
    }
};
