<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageDetails extends Model
{
    //
    protected $fillable = [
    'name',
    'status',
    'description',
    'logs'];
}
