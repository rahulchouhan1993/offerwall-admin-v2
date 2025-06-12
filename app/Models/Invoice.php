<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public function invoicedetails(){
        return $this->hasMany(InvoiceDetail::class);
    }

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
}
