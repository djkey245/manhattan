<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';
    //func
    public function galleries(){
        return $this->hasMany('App\Gallery');
    }
    public function getActive(){
        return $this->published()->get();

    }
    public function getBySlug($slug){
        return $this->published()->slug($slug)->firstOrFail();
    }

    //scope
    public function scopePublished($query){
        $query->where(['active' => 1]);
    }

    public function scopeSlug($query,$slug){
        $query->where(['slug' => $slug]);
    }

}
