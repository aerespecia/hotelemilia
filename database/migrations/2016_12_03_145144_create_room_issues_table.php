<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_issues', function (Blueprint $table){
            $table->increments('id');
            $table->timestamps();
            $table->integer('roomId');
            $table->integer('cleanerId');
            $table->integer('type');
            $table->integer('status');
            $table->text('notes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('room_issues');
    }
}
