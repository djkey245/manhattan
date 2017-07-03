<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function perm(){
        return $this->get();
    }

    public function register($itempost){
        return $this->insert(
            ['name' => $itempost['name'], 'surname' => $itempost['surname'], 'email' => $itempost['email'], 'password' => $itempost['pass'], 'actual' => $itempost['actual'], 'created_at' => $itempost['created_at']]
        );
    }
    public function updater($itempost){
        return $this->where('id', $itempost['id'])->update(
            //['name' => $itempost['name'], 'email' => $itempost['email'], 'password' => $itempost['pass'], 'actual' => $itempost['actual'], 'updated_at' => $itempost['updated_at']]
            ['name' => $itempost['name'], 'surname' => $itempost['surname'], 'email' => $itempost['email'],  'actual' => $itempost['actual'], 'updated_at' => $itempost['updated_at'],]
        );
    }

    public function testingEmail($itempost){
        return $this->where['email' == $itempost['email']]->get();
    }

    public function delusr($id){
        return $this->where(['id' => $id])->delete();
    }
    public function search_id($id){
        return $this->where(['id' => $id])->get();
    }


    public function scopeAdminuser($query){
        $query->where(['actual'=>2,]);
    }

}
