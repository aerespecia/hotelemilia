<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomAmendment extends Model
{
    //
    protected $fillable = ['status','id','roomToId','roomFromId','roomReservationId','userId','notes'];
}
