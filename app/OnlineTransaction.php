<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OnlineTransaction extends Model
{
    //
    protected $table = 'onlinetransactions';

    
    protected $fillable = [
    'accessId',
    'sourceId',
    'checkInDate',
    'checkOutDate',
    'bpFirstName',
    'bpLastname',
    'bpContactNo',
    'bpEmail',
    'bookingReference',
    'paypalReference',
    'totalAmount',
    'status',
    
	];
}


