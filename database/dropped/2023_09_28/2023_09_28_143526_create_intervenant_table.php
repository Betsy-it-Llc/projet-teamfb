<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIntervenantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('intervenant', function (Blueprint $table) {
            $table->integer('id_intervenant_')->primary();
            $table->string('ville_intervention', 50)->nullable();
            $table->string('role_', 50)->nullable();
            $table->text('description')->nullable();
            $table->dateTime('date_creation')->nullable();
            $table->dateTime('date_update')->nullable();
            $table->integer('id_contact')->unique('id_contact');
            
            $table->foreign('id_contact', 'intervenant_ibfk_1')->references('id_contact')->on('contact');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('intervenant');
    }
}
