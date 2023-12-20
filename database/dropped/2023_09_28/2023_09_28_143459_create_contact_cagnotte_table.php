<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactCagnotteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_cagnotte', function (Blueprint $table) {
            $table->integer('id_contact');
            $table->integer('id_cagnotte');
            
            $table->primary(['id_contact', 'id_cagnotte']);
            $table->foreign('id_contact', 'contact_cagnotte_ibfk_1')->references('id_contact')->on('contact');
            $table->foreign('id_cagnotte', 'contact_cagnotte_ibfk_2')->references('id_cagnotte')->on('cagnottes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_cagnotte');
    }
}
