<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMaintenance extends Model
{
    protected $guarded = [];

    public function maintenance()
    {
        return $this->belongsTo(Maintenance::class);
    }
    public function maintenancetype()
    {
        return $this->belongsTo(MaintenanceType::class,'maintenance_type_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
