<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartenaireTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partenaire', function (Blueprint $table) {
            $table->integer('id_partenaire')->primary();
            $table->string('fonction', 50)->nullable();
            $table->string('type', 50)->nullable();
            $table->text('description')->nullable();
            $table->dateTime('date_creation')->nullable();
            $table->date('date_update')->nullable();
            $table->integer('id_contact')->unique('id_contact');
            
            $table->foreign('id_contact', 'partenaire_ibfk_1')->references('id_contact')->on('contact');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partenaire');
    }
}
