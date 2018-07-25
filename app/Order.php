<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    
    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function invoice()
    {
        return $this->hasOne('App\Invoice');
    }
}