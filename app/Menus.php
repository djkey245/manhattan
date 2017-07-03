<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menus extends Model
{
    protected $table = 'menuses';


    public function column_id($id){

        return $this->where(['id' => $id])->get();

    }
    public function column_name($name_eng){
        return $this->where(['name_eng' => $name_eng])->get();
    }
    public function delete_item($id){

        return $this->where(['id' => $id])->delete();

    }
    public function active(){
        return $this->where(['active' => 1])->orderBy('actual', 'asc')->get();
    }


}
