<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReleveCampagneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('releve_campagne', function (Blueprint $table) {
            $table->integer('id_releve_campagne');
            $table->integer('id_campagne');
            $table->string('statut_releve', 45)->nullable();
            $table->dateTime('date_releve')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('releve_campagne');
    }
}
