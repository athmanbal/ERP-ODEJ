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
        Schema::create('fonctionnaires', function (Blueprint $table) {
            $table->comment('TRIAL');
            $table->double('id_fonctionnaire', null, 0)->nullable()->unique('primarykey')->comment('TRIAL');
            $table->double('matricule_fonctionnaire', null, 0)->nullable()->comment('TRIAL');
            $table->string('nom_fonctionnaire')->nullable()->comment('TRIAL');
            $table->string('prenom_fonctionnaire')->nullable()->comment('TRIAL');
            $table->dateTime('date_naissance')->nullable()->comment('TRIAL');
            $table->dateTime('date_recretement')->nullable()->comment('TRIAL');
            $table->double('nbr_annees', null, 0)->nullable()->comment('TRIAL');
            $table->dateTime('date_sortie')->nullable()->comment('TRIAL');
            $table->string('sexe')->nullable()->index('fonctionnaireid_sexe')->comment('TRIAL');
            $table->string('lieu_naissance')->nullable()->comment('TRIAL');
            $table->double('id_grade', null, 0)->nullable()->comment('TRIAL');
           $table->unsignedBigInteger('id_fonction')->nullable()->index('fonctionnaireid_fonction')->comment('TRIAL');
            $table->double('id_service', null, 0)->nullable()->comment('TRIAL');
            $table->double('n_ss', null, 0)->nullable()->comment('TRIAL');
            $table->double('id_categoriefonctionnaire', null, 0)->nullable()->comment('TRIAL');
            $table->string('id_situationfamiliale')->nullable()->comment('TRIAL');
            $table->string('femme_foyer')->nullable()->comment('TRIAL');
            $table->double('nb_enfant', null, 0)->nullable()->comment('TRIAL');
            $table->double('nb_enf_ben', null, 0)->nullable()->comment('TRIAL');
            $table->double('nb_enf_sco', null, 0)->nullable()->comment('TRIAL');
            $table->double('id_echelon', null, 0)->nullable()->comment('TRIAL');
            $table->double('niveau_responsabilite', null, 0)->nullable()->comment('TRIAL');
            $table->double('id_compte', null, 0)->nullable()->comment('TRIAL');
            $table->char('trial739', 1)->nullable()->comment('TRIAL');
            $table->string('telephone')->nullable()->comment('Numéro de téléphone du fonctionnaire');

            $table->unsignedBigInteger('id_etablissement')->nullable()->comment('Établissement du fonctionnaire');
            $table->foreign('id_etablissement')
                ->references('id_etablissement')
                ->on('etablissements')
                ->onDelete('set null');





            $table->timestamps(); // ajoute created_at et updated_at

        });
    }

    /**
     * Reverse the migrations.
     */
public function down(): void
{
    Schema::table('fonctionnaire', function (Blueprint $table) {
        $table->dropForeign(['id_etablissement']);
    });
}
};
