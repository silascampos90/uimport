<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostShipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'from_postcode',
        'to_postcode',
        'from_weight',
        'to_weight',
        'cost',
        'file_shipment_id'
    ];

    protected $forcedNullFields = [];

    public function setAttribute($key, $value)
    {
        if ($value === '') {
            $value = null;
        }

        return parent::setAttribute($key, $value);
    }
}
