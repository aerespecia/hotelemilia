<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDownpayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
          Schema::create('downpayments', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('transactionId');
            $table->text('notes');
            $table->integer('paidThru');
            $table->integer('user_id');
            $table->float('amount');
            $table->binary('scanned_doc');
          

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
