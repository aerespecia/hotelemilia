<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomCharge extends Model
{
    //
    protected $fillable = [
    'guestReservationId',
	'type',
	'itemId',
	'price',
	'logs'];
}
