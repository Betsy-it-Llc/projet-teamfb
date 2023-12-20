<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactPersonaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_persona', function (Blueprint $table) {
            $table->integer('id_contact');
            $table->integer('id_persona');
            
            $table->primary(['id_contact', 'id_persona']);
            $table->foreign('id_contact', 'contact_persona_ibfk_1')->references('id_contact')->on('contact');
            $table->foreign('id_persona', 'contact_persona_ibfk_2')->references('id_persona')->on('persona');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_persona');
    }
}
