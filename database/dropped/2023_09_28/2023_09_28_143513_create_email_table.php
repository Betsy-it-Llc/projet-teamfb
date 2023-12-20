<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email', function (Blueprint $table) {
            $table->integer('id_cause')->primary();
            $table->string('expediteur', 200)->nullable();
            $table->string('destinataire', 200)->nullable();
            $table->string('sujet', 200)->nullable();
            $table->text('corps')->nullable();
            $table->date('date_envoi')->nullable();
            $table->string('cc', 50)->nullable();
            $table->string('bcc', 50)->nullable();
            $table->text('pieces_jointes')->nullable();
            $table->string('lu', 200)->nullable();
            $table->integer('id_cause_1')->nullable();
            $table->integer('id_contact');
            
            $table->foreign('id_contact', 'email_ibfk_2')->references('id_contact')->on('contact');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('email');
    }
}
