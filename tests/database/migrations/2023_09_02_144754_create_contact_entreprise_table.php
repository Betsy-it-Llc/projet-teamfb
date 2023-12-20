<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactEntrepriseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql2')->create('contact_entreprise', function (Blueprint $table) {
            $table->integer('id_contact')->primary();
            $table->string('type', 50)->nullable();
            $table->integer('id_organisation');
            
            $table->foreign('id_contact', 'contact_entreprise_ibfk_1')->references('id_contact')->on('contact');
            $table->foreign('id_organisation', 'contact_entreprise_ibfk_2')->references('id_organisation')->on('organisation');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_entreprise');
    }
}
