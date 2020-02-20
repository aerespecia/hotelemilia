<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    //
    protected $fillable = [
    'name',
    'type',
    'contactNo',
    'phone',
    'address',
    'groupId',
    'logs'];
}
