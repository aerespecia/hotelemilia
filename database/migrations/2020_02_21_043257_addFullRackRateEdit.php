<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFullRackRateEdit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public function up()
    {
        //
        //
        Schema::table('room_reservations', function (Blueprint $table) {
            //     $table->string('fullRackRateEdit');
             });
     
        Schema::table('room_amendments', function (Blueprint $table) {
            $table->string('fullRackRateEdit');
        //   $table->string('roomTypeBill');
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
