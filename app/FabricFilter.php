<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FabricFilter extends Model
{
    public static function filters()
    {
        $types = [
            'composition' => 'Compositioin',
            'color' => 'Color',
            'patterns' => 'Patterns',
            'catagory' => 'Catagory',
        ];

        return $types;
    }
}
