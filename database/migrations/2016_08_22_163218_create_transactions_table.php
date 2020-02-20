<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('code');
            $table->integer('clientId');
            $table->integer('type');
            $table->integer('packageId');
            $table->integer('status');
            $table->integer('chargeType');
            $table->integer('madeThru');
            $table->integer('guaranteed');
            $table->text('guaranteedNote');
            $table->text('specialRequestNotes');
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
        Schema::drop('transactions');
    }
}
