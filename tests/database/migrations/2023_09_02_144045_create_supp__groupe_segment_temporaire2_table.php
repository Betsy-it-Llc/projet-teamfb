<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppGroupeSegmentTemporaire2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('supp__groupe_segment_temporaire2', function (Blueprint $table) {
            $table->text('id_groupe')->nullable();
            $table->integer('id_segment')->nullable();
            $table->text('Lettre_segment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supp__groupe_segment_temporaire2');
    }
}
