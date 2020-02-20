<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiscountDetails extends Model
{
    //

    protected $table = 'discount_details';

    
    protected $fillable = [
    'name',
    'type',
    'discountValue',
    'logs'];
}
