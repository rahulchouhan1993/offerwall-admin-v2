<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    protected $fillable = [
        'appId',
        'secrect_key',
        'affiliateId',
        'appName',
        'appUrl',
        'currencyName',
        'currencyNameP',
        'currencyValue',
        'rounding',
        'postback',
        'status',
        'affiliate_status',
    ];

    public function users(){
        return $this->hasOne(User::class,'id','affiliateId');
    }
    
}
