<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSession extends Model
{
    protected $guarded=[];
    public function sessiontype(){
        return $this->belongsTo(SessionType::class,'session_type_id');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
