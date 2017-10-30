<?php

namespace App\Http\Controllers;

use App\History;
use App\Virtual;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Peoples;
use App\Server;
use App\Menus;
use App\Comments;
class CardController extends Controller
{
    public function comment_page_add($id){

        $this->data['id'] = $id;

        return view('list.card.comment', $this->data);
    }
    public function comment_add(Request $request, Comments $comments){

        $com = $request->input();
        unset($com['_token']);
        $com += ['data' => date("Y-m-j H:i:s")];
        $this->history( $com['id_user'] ,'comment', 'comments', $com['id_people'] );
        $comments->insert($com);


    }
    public function server_edit(Peoples $peoples, $slug, Server $server){
        $id = $slug;
        $this->data['peoples'] = $peoples->perm($id);
        $this->data['srv_vrt'] = $server->where(['purpose' => 'vrt'])->get();
        $this->data['srv_rdp'] = $server->where(['purpose' => 'rdp'])->get();
        $this->data['id'] = $id;
        return view('list.card.server_edit', $this->data);
    }
    public function virtual_edit_vrt(Peoples $peoples, $slug, Virtual $virtual, Request $request){
        $id = $slug;
        $itempost = $request->input();

        $this->data['peoples'] = $peoples->perm($id);
        $this->data['id'] = $id;
        $this->data['id_server'] = $itempost['id_server'];
        $this->data['type'] = $itempost['type'];
        $this->data['virtuals'] = $virtual->where(['id_server' => $itempost['id_server']])->get();


        return view('list.card.virtual_edit_vrt', $this->data);

    }
    public function virtual_edit_rdp(Peoples $peoples, $slug, Virtual $virtual, Request $request){
        $id = $slug;
        $itempost = $request->input();
        $this->data['peoples'] = $peoples->perm($id);
        $this->data['id'] = $id;
        $this->data['id_server'] = $itempost['id_server'];
        $this->data['type'] = $itempost['type'];

        return view('list.card.virtual_edit_rdp', $this->data);
    }
    public function virtual_save_vrt(Peoples $peoples, $slug,  Request $request, History $history){
        $id = $slug;
        $itempost = $request->input();
        $virtual_value = $peoples->where(['id' => $id])->firstOrFail();
        $virtuals = $virtual_value['virtuals'];
        $virtuals .= $itempost['id_virtual'].',';
        $peoples->where(['id' => $id])->update(['virtuals' => $virtuals]);
        //return dd();
        //history
        $id_user = $itempost['id_user'];
        $data = $id;
        $this->history( $id_user ,'update', 'peoples', $data );
    }
    public function virtual_save(Request $request, Peoples $peoples, Virtual $virtual){

        $itempost = $request->input();
        $id_user = $itempost['id_user'];
        $id_people = $itempost['id_people'];
        unset($itempost['_token']);
        unset($itempost['id_user']);
        unset($itempost['id_people']);
        $virtual->insert($itempost);
        $id_virtual = $virtual->select('id')->where(['name' => $itempost['name'], 'ip' => $itempost['ip']])->firstOrFail();
        $people = $peoples->where(['id' => $id_people ])->firstOrFail();
        $virtuals = $people->virtuals;
        $virtuals .= $id_virtual->id.',';
        $peoples->where(['id' => $id_people])->update(['virtuals' => $virtuals]);




    }
    public function virtual_delete(Request $request, Peoples $peoples, $people_id){
            $virtual = $peoples->select('virtuals')->where(['id' => $people_id])->firstOrFail();
            $virtual = $virtual->virtuals;
            $itempost = $request->input();
            $virtuals = explode(',', $virtual);
            $virtual = "";
            $num = count($virtuals);
            for($i = 0; $i<$num; $i++){
                if(!empty($virtuals[$i])){
                    if($virtuals[$i] == $itempost['id']){
                        unset($virtuals[$i]);
                    }
                    else{
                        $virtual .= $virtuals[$i].',';
                    }
                }


            }
        $peoples->where(['id' => $people_id])->update(['virtuals' => $virtual]);
        //history
        $id_user = $itempost['id_user'];
        $data = $people_id;
        $this->history( $id_user ,'update', 'peoples', $data );
    }

    public function wifi($id, Peoples $peoples){
        $people = $peoples->where(['id' => $id])->firstOrFail();
        $login_wifi = explode('@', $people->mail);
        $login_wifi = $login_wifi['0'];
        $pass_wifi = rand('1000', '9999');
        require('Class/RouterosAPI.php');
        $API = new RouterosAPI();

        $API->debug = false;

        if($API->connect('192.168.11.32', 'admin', 'mikrotikcore')){
            //$API->write('/caps-man/registration-table/print');
            if($API->comm("/ip/hotspot/user/add", array(
                    "name" => $login_wifi,
                    "password" => $pass_wifi
            )
            )){
                $people->update(['wifi_login' => $login_wifi, "wifi_pass" => $pass_wifi]);
            }



            $API->disconnect();
        }

    }
}
