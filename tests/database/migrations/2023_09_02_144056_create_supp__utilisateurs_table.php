<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppUtilisateursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('supp__utilisateurs', function (Blueprint $table) {
            $table->unsignedBigInteger('id_utilisateur');
            $table->string('nom');
            $table->string('prenom');
            $table->string('genre')->nullable();
            $table->string('url_utilisateur')->nullable();
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
        Schema::dropIfExists('supp__utilisateurs');
    }
}
