<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampagneSegmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('campagne_segment', function (Blueprint $table) {
            $table->unsignedBigInteger('id_segment')->index('fk_id_segment');
            $table->unsignedInteger('id_campagne')->index('fk1_id_campagne');
            $table->string('lien_legende_post_partage', 255)->nullable();
            $table->string('legende_post_partage', 455)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campagne_segment');
    }
}
