<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fabric extends Model
{

    public function images()
    {
        return $this->hasMany('App\Image');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product');
    }
}
