<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppUtilisateurssssTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('supp__utilisateurssss', function (Blueprint $table) {
            $table->bigIncrements('id_utilisateur')->index();
            $table->string('Nom', 255)->nullable();
            $table->string('prenom', 255)->nullable();
            $table->string('genre', 255)->nullable();
            $table->string('url_utilisateur', 255)->nullable();
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
        Schema::dropIfExists('supp__utilisateurssss');
    }
}
