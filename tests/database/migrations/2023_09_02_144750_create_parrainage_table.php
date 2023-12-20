<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParrainageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql2')->create('parrainage', function (Blueprint $table) {
            $table->integer('id_parrainage')->primary();
            $table->integer('id_code')->unique('id_code');
            $table->string('statut_parrainage', 50)->nullable();
            
            $table->foreign('id_code', 'parrainage_ibfk_1')->references('id_code')->on('codes_promo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parrainage');
    }
}
