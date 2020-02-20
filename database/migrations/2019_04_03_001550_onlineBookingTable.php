<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OnlineBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('onlineTransactions', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('accessId');
            $table->integer('sourceId');
            $table->date('checkInDate');
            $table->date('checkOutDate');
            $table->string('bpFirstName');
            $table->string('bpLastName');
            $table->string('bpContactNo');
            $table->string('bpEmail');
            $table->string('bookingReferenceNo');
            $table->string('paypalReference');
            $table->decimal('totalAmount',10,4);
       
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
        //
    }
}
