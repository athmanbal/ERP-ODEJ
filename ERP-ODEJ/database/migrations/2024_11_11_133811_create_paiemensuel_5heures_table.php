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
        Schema::create('paiemensuel_5heures', function (Blueprint $table) {
            $table->comment('TRIAL');
            $table->double('id_paiemensuel_5heures', null, 0)->nullable()->unique('primarykey')->comment('TRIAL');
            $table->double('id_fonctionnaire', null, 0)->nullable()->comment('TRIAL');
            $table->double('annee', null, 0)->nullable()->comment('TRIAL');
            $table->double('mois', null, 0)->nullable()->comment('TRIAL');
            $table->double('i_f_s_p', null, 0)->nullable()->comment('TRIAL');
            $table->string('indemnite_nuisance')->nullable()->comment('TRIAL');
            $table->double('prime_resp', null, 0)->nullable()->comment('TRIAL');
            $table->double('retenue_mutuelle', null, 0)->nullable()->comment('TRIAL');
            $table->double('panier', null, 0)->nullable()->comment('TRIAL');
            $table->double('transport', null, 0)->nullable()->comment('TRIAL');
            $table->double('retenue_irg', null, 0)->nullable()->comment('TRIAL');
            $table->double('retenue_os', null, 0)->nullable()->comment('TRIAL');
            $table->double('prime_terr_spe', null, 0)->nullable()->comment('TRIAL');
            $table->double('prime_cont', null, 0)->nullable()->comment('TRIAL');
            $table->double('prime_delegation', null, 0)->nullable()->comment('TRIAL');
            $table->double('prime_iscp_con', null, 0)->nullable()->comment('TRIAL');
            $table->double('prime_docu', null, 0)->nullable()->comment('TRIAL');
            $table->dateTime('ifc')->nullable()->comment('TRIAL');
            $table->dateTime('idr')->nullable()->comment('TRIAL');
            $table->double('guiche', null, 0)->nullable()->comment('TRIAL');
            $table->double('isac_istc', null, 0)->nullable()->comment('TRIAL');
            $table->double('prime_risque', null, 0)->nullable()->comment('TRIAL');
            $table->string('iep')->nullable()->comment('TRIAL');
            $table->string('salaire_base')->nullable()->comment('TRIAL');
            $table->double('salaire_unique', null, 0)->nullable()->comment('TRIAL');
            $table->double('allocation_familiale', null, 0)->nullable()->comment('TRIAL');
            $table->string('retenu_s_soc')->nullable()->comment('TRIAL');
            $table->string('ind_10')->nullable()->comment('TRIAL');
            $table->double('ifs', null, 0)->nullable()->comment('TRIAL');
            $table->double('rigisseur', null, 0)->nullable()->comment('TRIAL');
            $table->double('diff_smig', null, 0)->nullable()->comment('TRIAL');
            $table->string('taux_horaire')->nullable()->comment('TRIAL');
            $table->double('fils_chahid', null, 0)->nullable()->comment('TRIAL');
            $table->string('nb_jours')->nullable()->comment('TRIAL');
            $table->double('categorie', null, 0)->nullable()->comment('TRIAL');
            $table->double('echelon', null, 0)->nullable()->comment('TRIAL');
            $table->string('salaire_brut')->nullable()->comment('TRIAL');
            $table->double('sal_imp', null, 0)->nullable()->comment('TRIAL');
            $table->string('net_a_payer')->nullable()->comment('TRIAL');
            $table->char('trial743', 1)->nullable()->comment('TRIAL');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiemensuel_5heures');
    }
};
