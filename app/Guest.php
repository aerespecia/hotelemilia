<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    //
    protected $fillable = [
    'code',
    'firstName',
    'middleName',
    'familyName',
    'age',
    'address',
    'phone',
    'contactNo',
    'uploadDocs',
    'logs'];
}
