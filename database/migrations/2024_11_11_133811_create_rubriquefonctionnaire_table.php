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
        Schema::create('rubriquefonctionnaire', function (Blueprint $table) {
            $table->comment('TRIAL');
            $table->integer('id_fonctionnaire')->nullable()->index('rubrique_fonctionnaireid_fonctionnaire')->comment('TRIAL');
            $table->decimal('salaire_de_base', 19, 4)->nullable()->comment('TRIAL');
            $table->decimal('iep', 19, 4)->nullable()->comment('TRIAL');
            $table->decimal('salaide_principal', 19, 4)->nullable()->comment('TRIAL');
            $table->decimal('nombre_echlon', 19, 4)->nullable()->comment('TRIAL');
            $table->decimal('istc', 19, 4)->nullable()->comment('TRIAL');
            $table->decimal('isac', 19, 4)->nullable()->comment('TRIAL');
            $table->decimal('isaa351', 19, 4)->nullable()->comment('TRIAL');
            $table->decimal('isaa352', 19, 4)->nullable()->comment('TRIAL');
            $table->decimal('nuis', 19, 4)->nullable()->comment('TRIAL');
            $table->decimal('irg', 19, 4)->nullable()->comment('TRIAL');
            $table->decimal('brut', 19, 4)->nullable()->comment('TRIAL');
            $table->decimal('brut_avec_retenu', 19, 4)->nullable()->comment('TRIAL');
            $table->decimal('retenu', 19, 4)->nullable()->comment('TRIAL');
            $table->string('typr_retenu')->nullable()->comment('TRIAL');
            $table->decimal('retenumutuel', 19, 4)->nullable()->comment('TRIAL');
            $table->decimal('retenuavances', 19, 4)->nullable()->comment('TRIAL');
            $table->decimal('ss', 19, 4)->nullable()->comment('TRIAL');
            $table->decimal('qped', 19, 4)->nullable()->comment('TRIAL');
            $table->decimal('doc', 19, 4)->nullable()->comment('TRIAL');
            $table->decimal('iexppedag', 19, 4)->nullable()->comment('TRIAL');
            $table->decimal('ispg', 19, 4)->nullable()->comment('TRIAL');
            $table->decimal('ifc', 19, 4)->nullable()->comment('TRIAL');
            $table->decimal('af', 19, 4)->nullable()->comment('TRIAL');
            $table->decimal('bounification', 19, 4)->nullable()->comment('TRIAL');
            $table->decimal('regi', 19, 4)->nullable()->comment('TRIAL');
            $table->string('poste_specifique')->nullable()->comment('TRIAL');
            $table->decimal('net_a_payer', 19, 4)->nullable()->comment('TRIAL');
            $table->string('mois')->nullable()->comment('TRIAL');
            $table->string('annee')->nullable()->comment('TRIAL');
            $table->char('trial746', 1)->nullable()->comment('TRIAL');

            $table->unique(['id_fonctionnaire', 'mois', 'annee'], 'primarykey');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rubriquefonctionnaire');
    }
};
