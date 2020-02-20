<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_charges', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('guestReservationId');
            $table->integer('type');
            $table->integer('itemId');
            $table->float('price');
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
        Schema::drop('room_charges');
    }
}
