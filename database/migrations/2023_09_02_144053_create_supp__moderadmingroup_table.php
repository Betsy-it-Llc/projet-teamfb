<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppModeradmingroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('supp__moderadmingroup', function (Blueprint $table) {
            $table->integer('id_utilisateur')->index('fk_id_utilisateur');
            $table->string('id_groupe')->index('fk_id_groupe');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supp__moderadmingroup');
    }
}
