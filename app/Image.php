<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['file', 'caption'];

    public function fabric(){
        return $this->belongsTo('App\Fabric');
    }
    
    public function style(){
        return $this->belongsTo('App\Style');
    }
}