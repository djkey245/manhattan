<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reportsadm extends Model
{
    protected $appends = 'points';
    public $timestamps = false;

    protected $fillable = ['id','user_id', 'type', 'date', 'time', 'title'];

    public function points(){
        return $this->hasMany(Point::class, 'reportsadm_id', 'id');
    }

}
