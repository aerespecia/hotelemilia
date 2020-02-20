<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('transactionId');
            $table->integer('roomId');
            $table->date('arrivalDate');
            $table->date('depatureDate');
            $table->time('checkInTime');
            $table->time('checkOutTime');
            $table->integer('discountId');
            $table->integer('type');
            $table->integer('status');
            $table->integer('reserveType');
            $table->date('initialDepartureDate');
            $table->integer('billingType');
            $table->text('billingNote');
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
        Schema::drop('room_reservations');
    }
}
