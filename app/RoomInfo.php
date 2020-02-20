<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomInfo extends Model
{
    //
    protected $fillable = [
    'roomName',
    'status',
    'type',
    'description'];
}
