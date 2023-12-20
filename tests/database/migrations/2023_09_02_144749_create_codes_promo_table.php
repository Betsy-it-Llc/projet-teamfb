<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCodesPromoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql2')->create('codes_promo', function (Blueprint $table) {
            $table->integer('id_code')->primary();
            $table->string('code', 50)->nullable();
            $table->integer('nb_utilisation')->nullable();
            $table->integer('nb_code')->default(0);
            $table->text('description')->nullable();
            $table->enum('statut_code', ['actif', 'inactif'])->default('actif');
            $table->dateTime('date_creation')->nullable();
            $table->dateTime('date_update')->nullable();
            $table->integer('id_remise');
            $table->string('id_stripe_code', 50)->nullable();
            $table->string('url_stripe_code', 2048)->nullable();
            
            $table->foreign('id_remise', 'codes_promo_ibfk_1')->references('id_remise')->on('remise');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('codes_promo');
    }
}
