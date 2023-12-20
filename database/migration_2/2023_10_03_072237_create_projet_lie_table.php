<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjetLieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projet_lie', function (Blueprint $table) {
            $table->integer('id_projet');
            $table->integer('id_projet_1');
            
            $table->primary(['id_projet', 'id_projet_1']);
            $table->foreign('id_projet', 'projet_lie_ibfk_1')->references('id_projet')->on('projets');
            $table->foreign('id_projet_1', 'projet_lie_ibfk_2')->references('id_projet')->on('projets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projet_lie');
    }
}
