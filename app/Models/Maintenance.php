<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    //
    protected $guarded=[];
    public function maintenancetype(){
        return $this->belongsTo(MaintenanceType::class);
    }

}
