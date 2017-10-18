<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Virtual extends Model
{
    protected $table = 'virtuals';

    public function contracts(){
        return $this->hasMany('App\Contracts');
    }
}
