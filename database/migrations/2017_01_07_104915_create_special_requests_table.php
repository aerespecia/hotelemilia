<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecialRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('special_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('roomReservationId');
            $table->date('requestDate');
            $table->time('requestTime');
            $table->text('note');
            $table->integer('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('special_requests');
    }
}
