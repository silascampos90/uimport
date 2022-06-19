<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipmentFile extends Model
{
    use HasFactory;

    protected $table = 'files_cost_shipment_imports';

   

    protected $fillable = [
        'name',
        'date_import',
        'size',
        'status_id',
        'execute'
    ];


    public function status(){
        return $this->hasOne(StatusImport::class, 'id', 'status_id');
    }




  
}
