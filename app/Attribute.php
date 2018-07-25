<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    public function sets()
    {
        return $this->belongsToMany('App\AttributeSet');
    }
}
