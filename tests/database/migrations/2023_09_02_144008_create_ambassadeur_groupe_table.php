<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmbassadeurGroupeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('ambassadeur_groupe', function (Blueprint $table) {
            $table->integer('id_ambassadeur');
            $table->string('id_groupe', 255);
            $table->string('statut_adhesion', 45)->nullable();
            $table->date('date_adhesion')->nullable();
            $table->string('notifications', 45)->nullable();
            $table->string('traitement', 255)->nullable();
            $table->string('statut_releve', 45)->nullable();
            $table->string('releve_100_posts', 45)->nullable();
            $table->integer('nb_posts_releves_analyse')->nullable();
            
            $table->primary(['id_ambassadeur', 'id_groupe']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ambassadeur_groupe');
    }
}
