<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomIssue extends Model
{
    //
    protected $fillable = [
						    'roomId',
						    'cleanerId',
						    'type',
						    'notes',
						    'status'
						  ];
}
