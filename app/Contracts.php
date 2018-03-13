<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contracts extends Model
{
    protected $table = 'contracts';
    public function virtual(){
        return $this->belongsToMany('App\Virtual');
    }

}
