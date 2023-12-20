<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelevePageLalachanteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('releve_page_lalachante', function (Blueprint $table) {
            $table->integer('id_releve');
            $table->integer('nb_abonnes')->nullable();
            $table->integer('nb_likes')->nullable();
            $table->integer('nb_vues')->nullable();
            $table->dateTime('date_releve')->nullable();
            $table->integer('id_campagne')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('releve_page_lalachante');
    }
}
