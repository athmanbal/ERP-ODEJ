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
        Schema::create('rebrique_categorie', function (Blueprint $table) {
            $table->comment('TRIAL');
            $table->double('id_rebrique_categorie', null, 0)->nullable()->unique('primarykey')->comment('TRIAL');
            $table->double('id_categorie', null, 0)->nullable()->comment('TRIAL');
            $table->double('id_rubrique', null, 0)->nullable()->comment('TRIAL');
            $table->double('id_fonctionnaire', null, 0)->nullable()->comment('TRIAL');
            $table->char('trial743', 1)->nullable()->comment('TRIAL');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rebrique_categorie');
    }
};
