<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documentation extends Model
{
    protected $fillable = [
            'title', 'text',  'documentationCategory_id', 'user_id'
    ];
}
