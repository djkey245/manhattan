<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    public function index(){
       return Redirect::to('/home');
    }

    public function register(Request $request,User $user){
        $itempost = $request->input();
        $itempost += [ 'created_at' => date("Y-m-j H:i:s"),];
        $itempost['pass'] = Hash::make($itempost['pass']);

           // if($user->testingEmail()[em])
               // {
               //     $email_error ="Користувач з таким емейлом вже зареєстрований";
               //     return $email_error;
               // }
            //else
               // {
                    $user->register($itempost);
                //}

        return 'User '.$itempost['name'].' successfully registered';


    }



    public function users(User $user){
        $this->data['users'] = $user->perm();
        return view('list.user', $this->data);
    }


    public function edit(Request $request,User $user){
        $itempost = $request->input();
        $itempost += [ 'updated_at' => date("Y-m-j H:i:s"),];
        //$itempost['pass'] = Hash::make($itempost['pass']);
        $user->updater($itempost);
        return 'User '.$itempost['name'].' successfully updated';
    }

    public function delete($id,User $user){

        $user_id = $id;
        $user->delusr($user_id);
        return $user_id;

    }

    public function userAjax($id,User $user){
        $this->data['user'] = $user->search_id($id);
        return view('list.ajax.edit_user', $this->data);
    }
}
