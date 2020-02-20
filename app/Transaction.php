<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    protected $fillable = [
    'code',
    'clientId',
    'type',
    'packageId',
    'status',
    'chargeType',
    'madeThru',
    'billingType',
    'billingNote',
    'guaranteed',
    'guaranteedNote',
    'specialRequestNotes',
    'logs'];
}

 /*
        1 Family Suite: 202, 208, 301, 308, 401, 408
2 Single Room: numbers 212, 312, 317, 318
3 Double Standard Room: 204, 205, 303, 304, 307, 403, 404, 407
4 Double Deluxe: 203, 302, 311, 402, 411
5 Twin Share: 206, 207, 209, 305, 306, 309, 315, 405, 406, 409


6 Twin Share Deluxe: 314
7 Tripple Sharing: 210, 310, 410
8 Hospitality Suite: 201
9 PWD Room: 211
10 Single Deluxe Room: numbers 313, 316 */