<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmbassadeursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('ambassadeurs', function (Blueprint $table) {
            $table->unsignedBigInteger('id_ambassadeur')->nullable()->unique('id_ambassadeur');
            $table->string('login');
            $table->string('mdp');
            $table->text('authentification_facebook')->nullable();
            $table->string('cookies', 9999)->nullable();
            $table->timestamps();
            
            $table->foreign('id_ambassadeur', 'ambassadeurs_ibfk_1')->references('id_utilisateur')->on('utilisateur');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ambassadeurs');
    }
}
