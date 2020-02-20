<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('code');
            $table->string('firstName');
            $table->string('middleName');
            $table->string('familyName');
            $table->string('houseNo');
            $table->string('brgy');
            $table->string('city');
            $table->string('country');
            $table->string('postalCode');
            $table->string('nationality');
            $table->string('contactNo');
            $table->string('email');
            $table->string('dob');
            $table->string('designation');
            $table->string('passNo');
            $table->string('passExpiry');
            $table->string('passIssue');
            $table->string('otherId');
            $table->binary('uploadDocs');
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
        Schema::drop('guests');
    }
}
