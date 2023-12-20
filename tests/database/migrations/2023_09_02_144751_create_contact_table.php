<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql2')->create('contact', function (Blueprint $table) {
            $table->integer('id_contact')->primary();
            $table->char('tel', 50)->nullable();
            $table->string('nom', 50)->nullable();
            $table->string('prenom', 50)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('adresse', 50)->nullable();
            $table->char('code_postal', 5)->nullable();
            $table->string('ville', 50)->nullable();
            $table->string('url_contact_folder', 2048)->nullable();
            $table->string('id_client_stripe', 50)->nullable();
            $table->string('url_client_stripe', 2048)->nullable();
            $table->text('description')->nullable();
            $table->dateTime('date_creation')->nullable();
            $table->dateTime('date_update')->nullable();
            $table->integer('id_parrainage')->nullable()->unique('id_parrainage');
            
            $table->foreign('id_parrainage', 'contact_ibfk_1')->references('id_parrainage')->on('parrainage');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact');
    }
}
