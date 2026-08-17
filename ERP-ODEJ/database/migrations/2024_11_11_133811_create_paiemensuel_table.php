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
        Schema::create('paiemensuel', function (Blueprint $table) {
            $table->comment('TRIAL');
            $table->double('id_paiemensuel', null, 0)->nullable()->unique('primarykey')->comment('TRIAL');
            $table->double('id_fonctionnaire', null, 0)->nullable()->index('paiemensuelid_fonctionnaire')->comment('TRIAL');
            $table->double('annee', null, 0)->nullable()->comment('TRIAL');
            $table->double('mois', null, 0)->nullable()->comment('TRIAL');
            $table->double('i_f_s_p', null, 0)->nullable()->comment('TRIAL');
            $table->double('indemnite_nuisance', null, 0)->nullable()->comment('TRIAL');
            $table->double('prime_resp', null, 0)->nullable()->comment('TRIAL');
            $table->double('retenue_mutuelle', null, 0)->nullable()->comment('TRIAL');
            $table->double('panier', null, 0)->nullable()->comment('TRIAL');
            $table->double('transport', null, 0)->nullable()->comment('TRIAL');
            $table->double('retenue_irg', null, 0)->nullable()->comment('TRIAL');
            $table->double('retenue_os', null, 0)->nullable()->comment('TRIAL');
            $table->string('prime_terr_spe')->nullable()->comment('TRIAL');
            $table->double('prime_cont', null, 0)->nullable()->comment('TRIAL');
            $table->double('prime_delegation', null, 0)->nullable()->comment('TRIAL');
            $table->double('prime_iscp_con', null, 0)->nullable()->comment('TRIAL');
            $table->double('prime_docu', null, 0)->nullable()->comment('TRIAL');
            $table->double('ifc', null, 0)->nullable()->comment('TRIAL');
            $table->double('idr', null, 0)->nullable()->comment('TRIAL');
            $table->double('guiche', null, 0)->nullable()->comment('TRIAL');
            $table->string('isac_istc')->nullable()->comment('TRIAL');
            $table->double('prime_risque', null, 0)->nullable()->comment('TRIAL');
            $table->double('iep', null, 0)->nullable()->comment('TRIAL');
            $table->double('taux_iep', null, 0)->nullable()->comment('TRIAL');
            $table->double('salaire_base', null, 0)->nullable()->comment('TRIAL');
            $table->double('salaire_unique', null, 0)->nullable()->comment('TRIAL');
            $table->double('allocation_familiale', null, 0)->nullable()->comment('TRIAL');
            $table->double('retenu_s_soc', null, 0)->nullable()->comment('TRIAL');
            $table->double('ind_10', null, 0)->nullable()->comment('TRIAL');
            $table->double('ifs', null, 0)->nullable()->comment('TRIAL');
            $table->double('rigisseur', null, 0)->nullable()->comment('TRIAL');
            $table->double('fils_chahid', null, 0)->nullable()->comment('TRIAL');
            $table->double('nb_jours', null, 0)->nullable()->comment('TRIAL');
            $table->double('categorie', null, 0)->nullable()->comment('TRIAL');
            $table->double('echelon', null, 0)->nullable()->comment('TRIAL');
            $table->double('salaire_brut', null, 0)->nullable()->comment('TRIAL');
            $table->double('sal_imp', null, 0)->nullable()->comment('TRIAL');
            $table->double('net_a_payer', null, 0)->nullable()->comment('TRIAL');
            $table->char('trial743', 1)->nullable()->comment('TRIAL');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiemensuel');
    }
};
