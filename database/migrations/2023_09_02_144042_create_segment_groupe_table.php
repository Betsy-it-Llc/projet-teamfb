<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSegmentGroupeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('segment_groupe', function (Blueprint $table) {
            $table->string('id_groupe');
            $table->integer('id_segment')->default(0)->index('segment_groupe_ibfk_2');
            
            $table->primary(['id_groupe', 'id_segment']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('segment_groupe');
    }
}
