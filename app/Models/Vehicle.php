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
        'vin',  // <--- Nuevo campo VIN
        'yellow_sheet',
        'blue_sheet',
        'history',
        'gas',
        'plas',
        'km',
        'key',
        'observations',
        'observations',
        'diagnostic',  // <--- Nuevos campos 
        'dismantling',
        'disassembly',
        'assembly',
        'mounting',
        'testing',
        'delivered',
    ];
}
