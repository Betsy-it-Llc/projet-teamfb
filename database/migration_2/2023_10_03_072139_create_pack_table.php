<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pack', function (Blueprint $table) {
            $table->integer('id_pack')->primary();
            $table->string('nom', 50)->nullable();
            $table->double('prix')->nullable();
            $table->text('abstract')->nullable();
            $table->text('description')->nullable();
            $table->integer('stock')->nullable();
            $table->dateTime('date_creation')->nullable();
            $table->dateTime('date_update')->nullable();
            $table->string('statut', 50)->nullable();
            $table->string('id_stripe_pack', 50)->nullable();
            $table->string('url_stripe_pack', 2048)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pack');
    }
}
