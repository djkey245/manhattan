<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    public function points(){
        return $this->hasMany(Point::class, 'id', 'test_id');
    }
}
