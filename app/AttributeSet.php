<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttributeSet extends Model
{
    public function attributes()
    {
        return $this->belongsToMany('App\Attribute');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
