<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomReplenishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_replenishes', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('roomId');
            $table->integer('roomItemId');
            $table->integer('noOfItem');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('room_replenishes');
    }
}
