<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Release extends Model
{
    protected $table = 'releases';

    public function list_event_action(){
        return $this->action()->get();
    }


    public function list_event(){
        return $this->orderBy('created_at', 'desc')->get();
    }
    public function register($item){
        $this->insert(
            ['id_user' => $item['id_user'], 'id_person' => $item['id_person'], 'event' => $item['event'], 'admin' => $item['admin'], 'chief' => $item['chief'], 'reason' => $item['reason'],
                'action' => $item['action'], 'created_at' => $item['created_at'],
                ]
        );
    }

    public function list_edit($id){

        return $this->id($id)->get();

    }
    public function updater($item){
        $this->id($item['id'])->update(
            [
                'admin' => $item['admin'], 'chief' => $item['chief'], 'reason' => $item['reason'], 'updated_at' => $item['updated_at'],
            ]
        );
    }
    public function deleter($id){
        return $this->id($id)->delete();
    }

    //scope
    public function scopeAction($query){

        return $query->where(['action' => 0]);

    }
    public function scopeId($query,$id){

        return $query->where(['id' => $id]);

    }

}
