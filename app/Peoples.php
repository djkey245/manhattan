<?php

namespace App;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Peoples extends Model
{
    protected $table = 'peoples';

    public function list_people(){
       return $this->get();
    }
    public function getBySlug($slug){
        return $this->slug($slug)->firstOrFail();
    }
    public function columns_peoples(){
        return $this->where(['id' => 0])->get();

    }

    public function registration($itempost){
        return $this->insert($itempost);
    }
    public function registration_a($itempost){
        return $this->insert(
            ['name' => $itempost['name'],'surname' => $itempost['surname'], 'birthday' => $itempost['birthday'],'profession' => $itempost['profession'],'skype' => $itempost['skype'],
                'mail' => $itempost['mail'],'mail_work' => $itempost['mail_work'],'phone' => $itempost['phone'],'action' => $itempost['action'],'created_at' => $itempost['created_at']]
        );
    }
    public function delusr($id){
        return $this->where(['id' => $id])->delete();
    }

    public function perm($id){
        return $this->where(['id' => $id])->get();
    }
    public function updater($itempost){
        return $this->where(['id' => $itempost['id']])->update($itempost);
    }
    public function updater_a($itempost){
        return $this->where(['id' => $itempost['id']])->update(
            ['name' => $itempost['name'],'surname' => $itempost['surname'], 'birthday' => $itempost['birthday'],'profession' => $itempost['profession'],'skype' => $itempost['skype'],
                'mail' => $itempost['mail'],'mail_work' => $itempost['mail_work'],'phone' => $itempost['phone'],'action' => $itempost['action'],'updated_at' => $itempost['updated_at']]
        );
    }
    public function list_active_people(){
        return $this->published()->get();
    }
    public function add_column($type, $name){
            if($type == 'string') {
                Schema::table('peoples', function (Blueprint $table)use($name) {

                    $table->string($name);
                });
            }
            if($type == 'integer'){
                Schema::table('peoples', function (Blueprint $table)use($name) {

                    $table->integer($name);
                });
            }
            if($type == 'longtext'){
                Schema::table('peoples', function (Blueprint $table) use($name) {
                    $table->longtext($name);
                });

            }
            if($type == 'date'){
                Schema::table('peoples', function (Blueprint $table) use($name) {
                    $table->date($name);
                });

            }
            else return 'Не виконано.';
               }

    public function delete_column($name){

        Schema::table('peoples', function (Blueprint $table) use($name) {
            $table->dropColumn($name);
        });


    }
    public function office($office){
        return $this->where(['office' => $office])->get();
    }



    //scope
    public function scopePublished($query){
        $query->where(['action' => 1]);
    }
    public function scopeSlug($query,$slug){
        $query->where(['id' => $slug]);
    }

}
