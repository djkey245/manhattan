<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Virtual;

class Point extends Model
{
    public $timestamps = false;
    protected $fillable = ['text', 'reportsadm_id', 'documentation_id'];

    public function virtuals(){
        return $this->hasMany(Virtual::class, 'id', 'virtual_id');
    }
}
