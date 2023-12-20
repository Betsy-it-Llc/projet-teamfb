<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrestationIntervenantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestation_intervenant', function (Blueprint $table) {
            $table->integer('id_prestation_intervenant')->primary();
            $table->string('type_service', 300)->nullable();
            $table->text('description')->nullable();
            $table->double('cout')->nullable();
            $table->string('unite', 50)->nullable();
            $table->dateTime('date_creation')->nullable();
            $table->dateTime('date_update')->nullable();
            $table->integer('id_intervenant_');
            
            $table->foreign('id_intervenant_', 'prestation_intervenant_ibfk_1')->references('id_intervenant_')->on('intervenant');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prestation_intervenant');
    }
}
