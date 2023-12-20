<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostpartagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql')->create('postpartages', function (Blueprint $table) {
            $table->unsignedBigInteger('id_post')->primary();
            $table->string('id_groupe', 255)->nullable()->index('fk3_id_groupe');
            $table->string('message_personnalise')->nullable();
            $table->string('statut')->nullable();
            $table->string('id_utilisateur')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('postpartages');
    }
}
