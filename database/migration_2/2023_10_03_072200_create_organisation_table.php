<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganisationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organisation', function (Blueprint $table) {
            $table->integer('id_organisation')->primary();
            $table->string('nom', 50)->nullable();
            $table->string('tel', 50)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('adresse', 50)->nullable();
            $table->string('code_postal', 50)->nullable();
            $table->string('ville', 50)->nullable();
            $table->integer('nb_salarie')->nullable();
            $table->string('num_cse', 50)->nullable();
            $table->text('description')->nullable();
            $table->dateTime('date_creation')->nullable();
            $table->dateTime('date_update')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organisation');
    }
}
