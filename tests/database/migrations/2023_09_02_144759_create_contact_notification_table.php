<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactNotificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mysql2')->create('contact_notification', function (Blueprint $table) {
            $table->integer('id_notification')->primary();
            $table->dateTime('date_creation')->nullable();
            $table->integer('id_contact');
            
            $table->foreign('id_notification', 'contact_notification_ibfk_1')->references('id_notification')->on('notification');
            $table->foreign('id_contact', 'contact_notification_ibfk_2')->references('id_contact')->on('contact');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_notification');
    }
}
