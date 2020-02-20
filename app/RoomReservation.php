<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomReservation extends Model
{
    //
    protected $fillable = [
    'transactionId',
    'roomId',
    'arrivalDate',
    'depatureDate',
    'checkInTime',
    'checkOutTime',
    'discountId',
    'type',
    'status',
    'reserveType',
    'billingType',
    'billingNote',
    'extensionDate',
    'logs'];
}
