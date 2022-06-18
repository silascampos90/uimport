<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipmentFile extends Model
{
    use HasFactory;

    protected $table = 'files_cost_shipment_imports';

    protected $dates = [
        'date_import'
    ];

    protected $fillable = [
        'name',
        'date_import',
        'size',
        'status_id',
        'execute'
    ];


    protected function asDateTime($value)
    {
        return parent::asDateTime($value)->format('d/m/y H:i');
    }
}
