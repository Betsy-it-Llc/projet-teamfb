<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppExportGroupWorkbenchtestimportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('supp__export group workbenchtestimport', function (Blueprint $table) {
            $table->text('id_groupe')->nullable();
            $table->text('nom')->nullable();
            $table->text('personnalisation')->nullable();
            $table->text('nb_membres')->nullable();
            $table->text('theme')->nullable();
            $table->text('type')->nullable();
            $table->text('reglementation')->nullable();
            $table->text('url_a_propos')->nullable();
            $table->text('frequence_post_mois')->nullable();
            $table->text('format_groupe')->nullable();
            $table->text('lieu')->nullable();
            $table->text('actif_supprime')->nullable();
            $table->text('statut_releve')->nullable();
            $table->text('date_releve')->nullable();
            $table->text('statut_integration')->nullable();
            $table->text('tag_recherche')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supp__export group workbenchtestimport');
    }
}
