<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactExperienceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_experience', function (Blueprint $table) {
            $table->integer('id_experience');
            $table->integer('id_contact');
            $table->string('profil', 50)->nullable();
            $table->string('personna', 50)->nullable();
            $table->text('description')->nullable();
            
            $table->primary(['id_experience', 'id_contact']);
            $table->foreign('id_experience', 'contact_experience_ibfk_1')->references('id_experience')->on('experience');
            $table->foreign('id_contact', 'contact_experience_ibfk_2')->references('id_contact')->on('contact');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_experience');
    }
}
