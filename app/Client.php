<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //

    

    protected $fillable = [
    'id',
    'firstname',
    'middleName',
    'lastName',
    'title',
    'contactNo',
    'phone',
    'address',
    'institutionId',
    'logs'];
}
