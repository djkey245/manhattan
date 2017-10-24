<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contracts extends Model
{
    protected $table = 'contracts';
    public function virtuals(){
        return $this->hasMany('App\Virtual');
    }
}
