<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invitations', function (Blueprint $table) {
            $table->integer('id_invitation')->primary();
            $table->string('email_invite', 200)->nullable();
            $table->dateTime('date_invite')->nullable();
            $table->string('statut', 50)->nullable();
            $table->integer('id_cagnotte');
            
            $table->foreign('id_cagnotte', 'invitations_ibfk_1')->references('id_cagnotte')->on('cagnottes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invitations');
    }
}
