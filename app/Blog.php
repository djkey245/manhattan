<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blog';

    public function getActive()
    {
        return $this->published()->latest()->paginate(2);
    }
    public function scopePublished($query)
    {
        $query->where(['active'=>'1']);
    }

    public function getBySlug($slug)
    {
        return $this->where(['slug' =>$slug])->firstOrFail();
    }
}
