<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Release;
use App\User;
use App\Peoples;
class ReleaseController extends Controller
{
    public function index(Release $release,User $user, Peoples $peoples){

        $this->data['releases_action'] = $release->list_event_action();
        $this->data['releases_all'] = $release->list_event();
        $this->data['users'] = $user->perm();
        $this->data['peoples'] = $peoples->list_people();

        return view('list.release', $this->data);

    }

    public function add_release(Peoples $peoples){
        $this->data['peoples'] = $peoples->list_active_people();
        return view('list.release.add',$this->data);
    }
    public function add_release_reg(Request $request, Release $release){
        $itempost = $request->input();
        $itempost += ['admin' => 0, 'chief' => 0, 'action' => 0,'created_at' => date("Y-m-j H:i:s")];
        $release->register($itempost);
    }

    public function edit_release_list($id, Release $release){

        $this->data['release'] = $release->list_edit($id);
        return view('list.release.edit',$this->data);

    }
    public function edit_release(Release $release, Request $request){

        $itempost = $request->input();
        $itempost += ['updated_at' => date("Y-m-j H:i:s")];
        $release->updater($itempost);

    }

    public  function deleter($id, Release $release){

        $release->deleter($id);

        return $id ;

    }
}
