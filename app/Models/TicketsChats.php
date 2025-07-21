<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketsChats extends Model
{
    protected $fillable = ['ticket_id', 'from', 'message'];

    public function ticket()
    {
        return $this->belongsTo(Tickets::class);
    }
}

