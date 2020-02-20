<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUpdatedByUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('account_types', function (Blueprint $table) {$table->integer('updatedby');});            
        Schema::table('bill_arrangement_types', function (Blueprint $table) {$table->integer('updatedby');});   
        Schema::table('charges', function (Blueprint $table) {$table->integer('updatedby');});                  
        Schema::table('clients', function (Blueprint $table) {$table->integer('updatedby');});                  
        Schema::table('discount_details', function (Blueprint $table) {$table->integer('updatedby');});         
        Schema::table('groups', function (Blueprint $table) {$table->integer('updatedby');});                   
        Schema::table('guest_reservations', function (Blueprint $table) {$table->integer('updatedby');});       
        Schema::table('guests', function (Blueprint $table) {$table->integer('updatedby');});                   
        Schema::table('housekeepings', function (Blueprint $table) {$table->integer('updatedby');});            
        Schema::table('institutions', function (Blueprint $table) {$table->integer('updatedby');});             
        Schema::table('items', function (Blueprint $table) {$table->integer('updatedby');});                    
        Schema::table('migrations', function (Blueprint $table) {$table->integer('updatedby');});               
        Schema::table('package_details', function (Blueprint $table) {$table->integer('updatedby');});          
        Schema::table('password_resets', function (Blueprint $table) {$table->integer('updatedby');});          
        Schema::table('perks_items', function (Blueprint $table) {$table->integer('updatedby');});              
        Schema::table('roles', function (Blueprint $table) {$table->integer('updatedby');});                    
        Schema::table('room_amendments', function (Blueprint $table) {$table->integer('updatedby');});          
        Schema::table('room_charges', function (Blueprint $table) {$table->integer('updatedby');});             
        Schema::table('room_infos', function (Blueprint $table) {$table->integer('updatedby');});               
        Schema::table('room_issues', function (Blueprint $table) {$table->integer('updatedby');});              
        Schema::table('room_reservations', function (Blueprint $table) {$table->integer('updatedby');});        
        Schema::table('room_types', function (Blueprint $table) {$table->integer('updatedby');});               
        Schema::table('shifts', function (Blueprint $table) {$table->integer('updatedby');});                   
        Schema::table('staff', function (Blueprint $table) {$table->integer('updatedby');});                    
        Schema::table('tests', function (Blueprint $table) {$table->integer('updatedby');});                    
        Schema::table('transactions', function (Blueprint $table) {$table->integer('updatedby');});             
        Schema::table('users', function (Blueprint $table) {$table->integer('updatedby');});
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
