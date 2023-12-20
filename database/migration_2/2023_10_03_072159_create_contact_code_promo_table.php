<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactCodePromoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_code_promo', function (Blueprint $table) {
            $table->integer('id_code');
            $table->integer('id_contact');
            
            $table->primary(['id_code', 'id_contact']);
            $table->foreign('id_code', 'contact_code_promo_ibfk_1')->references('id_code')->on('codes_promo');
            $table->foreign('id_contact', 'contact_code_promo_ibfk_2')->references('id_contact')->on('contact');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_code_promo');
    }
}
