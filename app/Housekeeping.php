<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Housekeeping extends Model
{
    //
    protected $fillable = [
    'roomInfoId',
    'cleanerId',
    'contactNo',
    'cleaningDate',
    'cleaningTime',
    'status',
    'from_status',
    'to_status'];
    
}
