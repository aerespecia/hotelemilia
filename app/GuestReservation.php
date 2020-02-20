<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuestReservation extends Model
{
    //
    protected $fillable = ['roomReservationId','guestId'];
}
