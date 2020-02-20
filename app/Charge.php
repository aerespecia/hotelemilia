<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Charge extends Model
{
    //protected $fillable = ['firstName','lastName', 'contactNo','address'];
    protected $fillable = ['transactionId','type','itemId', 'price', 'logs'};
}
