<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomCheckListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_check_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->integer('status');
        });

        Schema::create('room_cleaner_check_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('roomId');
            $table->integer('roomCheckId');
            $table->integer('issuedById');
            $table->integer('status');
            $table->text('remarks');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('room_check_lists');
    }
}
