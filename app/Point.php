<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    public $timestamps = false;
    protected $fillable = ['text', 'reportsadm_id', 'documentation_id'];

}
