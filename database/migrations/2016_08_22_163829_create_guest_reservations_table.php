<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuestReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guest_reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('guestId');
            $table->integer('roomReservationId');
            $table->integer('billType');
            $table->text('billNotes');
            $table->integer('chargeType');
            $table->binary('logs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('guest_reservations');
    }
}
