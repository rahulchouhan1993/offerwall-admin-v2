<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    
    public function user(){
        return $this->belongsTo(User::class,'visitor_user_id');
    }
}
