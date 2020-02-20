<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddToRoomAmmendment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('room_amendments', function (Blueprint $table) {
            $table->integer('transactionId');
            $table->integer('roomId');
            $table->date('arrivalDate');
            $table->date('depatureDate');
            $table->time('checkInTime');
            $table->time('checkOutTime');
            $table->integer('discountId');
            $table->integer('type');
            $table->integer('roomReservationstatus');
            $table->integer('reserveType');
            $table->date('extensionDate');
            $table->integer('billingType');
            $table->text('billingNote');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
