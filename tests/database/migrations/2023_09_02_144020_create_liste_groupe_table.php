<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListeGroupeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('liste_groupe', function (Blueprint $table) {
            $table->string('id_groupe', 255)->index('fk2_id_groupe');
            $table->integer('id_liste')->default(0)->index('fk_id_liste');
            $table->string('nom_liste', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('liste_groupe');
    }
}
