<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHousekeepingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('housekeepings', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('roomInfoId');
            $table->integer('cleanerId');
            $table->date('cleaningDate');
            $table->time('cleaningTime');
            $table->integer('type');
            $table->integer('status');
            $table->integer('from_status');
            $table->integer('to_status');
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
        Schema::drop('housekeepings');
    }
}
