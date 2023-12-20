<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppGroupesanssegmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('supp__groupesanssegments', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->string('id_groupe', 5000);
            $table->string('nom')->nullable();
            $table->string('personnalisation', 1000)->nullable();
            $table->string('nb_membres')->nullable();
            $table->string('theme', 1000)->nullable();
            $table->string('type')->nullable();
            $table->string('reglementation', 1000)->nullable();
            $table->string('url_a_propos')->nullable();
            $table->string('frequence_post_mois')->nullable();
            $table->string('format_groupe')->nullable();
            $table->string('lieu')->nullable();
            $table->string('actif_supprime')->nullable();
            $table->string('statut_releve')->nullable();
            $table->date('date_releve')->nullable();
            $table->string('statut_integration')->nullable();
            $table->string('tag_recherche')->nullable();
            $table->string('nom_ambassadeur')->nullable();
            $table->string('id_ambassadeur')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supp__groupesanssegments');
    }
}
