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
        Schema::create('prime-rendement', function (Blueprint $table) {
            $table->comment('TRIAL');
            $table->integer('n°')->unique('primarykey')->comment('TRIAL');
            $table->string('champ1')->nullable()->comment('TRIAL');
            $table->string('champ2')->nullable()->comment('TRIAL');
            $table->string('champ3')->nullable()->comment('TRIAL');
            $table->string('champ4')->nullable()->comment('TRIAL');
            $table->string('champ5')->nullable()->comment('TRIAL');
            $table->string('champ6')->nullable()->comment('TRIAL');
            $table->string('champ7')->nullable()->comment('TRIAL');
            $table->string('champ8')->nullable()->comment('TRIAL');
            $table->string('champ9')->nullable()->comment('TRIAL');
            $table->string('champ10')->nullable()->comment('TRIAL');
            $table->string('champ11')->nullable()->comment('TRIAL');
            $table->string('champ12')->nullable()->comment('TRIAL');
            $table->string('champ13')->nullable()->comment('TRIAL');
            $table->string('champ14')->nullable()->comment('TRIAL');
            $table->char('trial743', 1)->nullable()->comment('TRIAL');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prime-rendement');
    }
};
