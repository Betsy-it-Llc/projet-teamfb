<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('groupes', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->string('id_groupe', 255)->index('id_groupe');
            $table->string('nom');
            $table->string('personnalisation')->nullable();
            $table->string('nb_membres')->nullable();
            $table->string('theme')->nullable();
            $table->string('type')->nullable();
            $table->string('reglementation')->nullable();
            $table->string('url_a_propos')->nullable();
            $table->string('frequence_post_mois')->nullable();
            $table->string('format_groupe')->nullable();
            $table->string('lieu')->nullable();
            $table->string('actif_supprime')->nullable();
            $table->string('statut_releve')->nullable();
            $table->date('date_releve')->nullable();
            $table->string('statut_integration')->nullable();
            $table->string('tag_recherche')->nullable();
            $table->timestamps();
            
            $table->primary(['id', 'id_groupe']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groupes');
    }
}
