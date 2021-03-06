<?php

namespace App\Http\Controllers;

use App\Comments;
use App\Peoples;
use App\Menus;
use App\Report;
use App\Server;
use App\User;
use App\Virtual;
use Illuminate\Http\Request;
use Slug;
use App\Http\Requests;
use Auth;

class ListController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Peoples $peoples, Menus $menus)
    {
        $this->data['objects'] = $peoples->list_people();
        $this->data['items'] = $menus->active();

        //dd($this->data['objects']);
        return view('list.list', $this->data);
    }
    public function office(Peoples $peoples, Menus $menus, $office)
    {
        $this->data['objects'] = $peoples->office($office);
        $this->data['items'] = $menus->active();

        //dd($this->data['objects']);
        return view('list.list', $this->data);
    }
    public function card($slug, Peoples $peoples, Menus $menus, Comments $comments, User $user, Report $report, Virtual $virtual, Server $server){
        $this->data['items'] = $peoples->getBySlug($slug);
        $people  = $peoples->getBySlug($slug);
        $people_vrt = $people->virtuals;
        $virtual_id_explode = explode(',', $people_vrt);
        $num_vrt = count($virtual_id_explode);
        $virtuals_id = [];

        for($i = 0; $i<$num_vrt; $i++){
            if(empty($virtual_id_explode[$i])){
                unset($virtual_id_explode[$i]);
            }
            else{
                $id_vrt = $virtual->where(['id' => $virtual_id_explode[$i]])->firstOrFail();
                 array_push($virtuals_id, $id_vrt);
            }

        }
        $servers_id = [];
        foreach ($virtuals_id as $virtual_id){
            $id_srv = $server->where(['id' => $virtual_id->id_server])->firstOrFail();
            array_push($servers_id, $id_srv);
        }
        //dd($this->data['items']);
        $this->data['comments'] = $comments->where(['id_people' => $slug])->get();
        $this->data['menus'] = $menus->active();
        $this->data['users'] = $user->get();
        $this->data['virtuals'] = $virtuals_id;

        $this->data['servers'] = $servers_id;
        $reps = $report->get();
        $report_from_id = [];
        foreach ($reps as $rep){

            $id_peoples = explode(',',$rep['id_peoples']);
            foreach ($id_peoples as $id_people){
                if($slug == $id_people){
                    array_push($report_from_id,$rep);
                }

            }

        }
        $this->data['reports'] = $report_from_id;
        return view('list.card', $this->data);

    }
    public function card_edit(Peoples $peoples, $slug,Menus $menu){
        $id = $slug;
        $this->data['peoples'] = $peoples->perm($id);
        $this->data['menuses'] = $menu->active();
        return view('list.list.card', $this->data);
    }

    public function list_add(Peoples $peoples, Menus $menu){
        $this->data['menuses'] = $menu->active();

        return view('list.list.list_add', $this->data);
    }

    public function register(Request $request, Peoples $peoples){
        $tempvalue;
        $itempost = $request->input();
        $id_user = $itempost['id_user'];
        $a = count($itempost['val']);
        for($i = 0; $i<$a; $i++){

            $tempvalue[$i] = $itempost['val'][$i]['0'];
        }
        //unset($itempost['_token']);
        //$item = json_decode($itempost['keys']);
        //$itempost['mas'] += [ 'created_at' => date("Y-m-j H:i:s")];
        $item = array_combine($itempost['keys'], $tempvalue);
        $item += ['created_at' => date("Y-m-j H:i:s")];

        $peoples->insert($item);


        //history
        $data = $peoples->select('id')->where(['name' => $item['name'], 'surname' => $item['surname']])->get();
        $this->history( $id_user ,'insert', 'peoples', $data );





    }

    public function delete($id,Peoples $peoples,Request $request){
        $itempost = $request->input();
        $name = $peoples->where(['id' => $id])->get();
        $name = $name['0']->name.' '.$name['0']->surname;
        $id_user = $itempost['id_user'];
        $this->history( $id_user ,'delete', 'peoples', $name );

        $peoples->delusr($id);
        return $id;

    }

    public function list_edit(Peoples $peoples, $id,Menus $menu){

        $this->data['peoples'] = $peoples->perm($id);
        $this->data['menuses'] = $menu->active();
        return view('list.list.list_edit', $this->data);


    }


    public function updater(Request $request, Peoples $peoples){

        $tempvalue;
        $itempost = $request->input();
        //history()
        $id_user = $itempost['id_user'];
        $data = $itempost['id'];


        //
        $a = count($itempost['val']);
        for($i = 0; $i<$a; $i++){

            $tempvalue[$i] = $itempost['val'][$i]['0'];
        }
        $item = array_combine($itempost['keys'], $tempvalue);
        $item += [ 'updated_at' => date("Y-m-j H:i:s"), 'id' => $itempost['id']];


        $this->history( $id_user ,'update', 'peoples', $data );
        $peoples->updater($item);
        return 'Person '.$item['name'].' successfully updated';
    }
    public function updater_a(Request $request, Peoples $peoples){

        $itempost = $request->input();
        $itempost += [ 'updated_at' => date("Y-m-j H:i:s")];

        $peoples->updater_a($itempost);
        return 'Person '.$itempost['name'].' successfully updated';
    }
    public function page_search(Peoples $peoples, Menus $menus){
        $this->data['id'] = $peoples->select('id');
        $this->data['id'] = json_encode($this->data['id']);
        return view('list/list/search', $this->data);
    }
    public function search(Request $request, Peoples $peoples, Menus $menus){

            $word = $request->input('referal');
            $word = htmlspecialchars(stripcslashes(trim($word)));
            $names = $menus->select('name_eng')->get();
            $this->data['objects'] = $peoples->list_people();
            $this->data['items'] = $menus->orderBy('actual')->get();
            $this->data['search'] = $word;
            $name;
            $search = '';
            $id = [];
            foreach($names as $name) {
                $searches = $peoples->select('id')->where($name->name_eng, 'LIKE', '%' . $word . '%')->get();
                foreach ($searches as $search) {

                    if (!empty($search)) {
                        array_push($id, $search->id);
                    }
                }
            }




            $this->data['search'] = array_unique($id);

            return view('list.list.searching', $this->data);
    }

}
