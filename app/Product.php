<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $casts = [
        'associated_products' => 'array',
    ];

    public function fabrics()
    {
        return $this->belongsToMany('App\Fabric');
    }

    public function linings()
    {
        return $this->belongsToMany('App\Lining');
    }

    public function styles()
    {
        return $this->belongsToMany('App\Style');
    }

    public function attribute_set()
    {
        return $this->hasOne('App\AttributeSet');
    }

}