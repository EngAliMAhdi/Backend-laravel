<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewbornUser extends Model
{
    protected $guarded=[];
    public function placement(){
        return $this->belongsTo(Placement::class);
    }
    public function position(){
        return $this->belongsTo(Position::class);
    }
    public function food(){
        return $this->belongsTo(Food::class);
    }
    public function season(){
        return $this->belongsTo(Season::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
