<?php

namespace App\Http\Controllers;

use App\Comments;
use App\History;
use App\Menus;
use App\Peoples;
use App\Server;
use App\Virtual;
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

                //}
        $user->register($itempost);



        //history
        $data = $user->select('id')->where(['name' => $itempost['name'], 'surname' => $itempost['surname']])->get();
        $id_user = $itempost['id_user'];
        $this->history( $id_user ,'insert', 'user', $data );
        //


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



        //history
        $data = $itempost['id'];
        $id_user = $itempost['id_user'];
        $this->history( $id_user ,'update', 'user', $data );
        //



        return 'User '.$itempost['name'].' successfully updated';
    }

    public function delete($id,User $user, Request $request){
        $itempost = $request->input();
        $user_id = $id;
        $name = $user->where(['id' => $id])->get();
        $names = $name['0']->name.' '.$name['0']->surname;
        $user->delusr($user_id);

        //history
        $id_user = $itempost['id_user'];
        $data = $names;

        $this->history( $id_user ,'delete', 'user', $data );
        //

        return $user_id;

    }

    public function userAjax($id,User $user){
        $this->data['user'] = $user->search_id($id);
        return view('list.ajax.edit_user', $this->data);
    }

    public function history_page(History $history, Menus $menus, Peoples $peoples, User $user, Comments $comments, Virtual $virtual,Server $server){

        $this->data['history'] = $history->orderBy('id', 'desc')->paginate(10);
        $this->data['menus'] = $menus->get();
        $this->data['peoples'] = $peoples->get();
        $this->data['users'] = $user->get();
        $this->data['comments'] = $comments->get();
        $this->data['servers'] = $server->get();
        $this->data['virtuals'] = $virtual->get();

        return view('list.history', $this->data);
    }
}
