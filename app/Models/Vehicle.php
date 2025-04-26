<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'date',
        'vehicle',
        'color',
        'plates',
        'service_type',
        'order_number',
        'yellow_sheet',
        'blue_sheet',
        'history',
        'gas',
        'plas',
        'km',
        'key',
        'observations',
    ];
}
