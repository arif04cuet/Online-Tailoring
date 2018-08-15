<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LiningFilter extends Model
{
    public static function filters()
    {
        $types = [
            'category' => 'Catagory',
        ];

        return $types;
    }
}
