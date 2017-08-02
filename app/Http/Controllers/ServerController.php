<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Server;
use App\Virtual;
use App\Http\Requests;

class ServerController extends Controller
{

    public function index(Server $server,Virtual $virtual){
        $this->data['servers'] = $server->get();
        $this->data['virtuals'] = $virtual->get();
        return view('list.server',$this->data);
    }

    public function page_add(){

        return view('list.server.page_add');
    }
    public function page_add_1(Request $request, Server $server){
        $itempost = $request->input();

        if(empty($itempost['name'])){
            $this->data['error'] = 'Не введено ім’я сервера!';
            return view('list.server.page_add', $this->data);
        }
        else{
        $this->data['name'] = $itempost['name'];
        $this->data['ip'] = $itempost['ip'];
        $this->data['vnc'] = $itempost['vnc'];
        $this->data['rdp'] = $itempost['rdp'];
        $itempost += [ 'created_at' => date("Y-m-j H:i:s"),];
        unset($itempost['_token']);
        $server->insert($itempost);
        $id = $server->select('id')->where(['name' => $itempost['name'],])->firstOrFail();
        $this->data['id'] = $id->id;
        return view('list.server.page_add_1', $this->data);
        }
    }
    public function save(Request $request, Virtual $virtual){
        $itempost = $request->input();
        $insert = $itempost;
        $name;$ip;$lp;
        unset($insert['_token']);
        unset($insert['vrt']);
        unset($insert['id_serv']);
        $virtuals = explode(';', $itempost['vrt']);
        $items = [];
        $count = count($virtuals);
        unset($virtuals[$count-1]);
        for($i = 0; $i < $count-1; $i++) {
            $items = explode(',', $virtuals[$i]);
            if(!empty($items[0]) or !empty($items[1]) or !empty($items[0])) {

                $insert = ['name' => $items[0],];
                $insert += ['ip' => $items[1],];
                $insert += ['lp' => $items[2],];
                $insert += ['id_server' => $itempost['id_serv'],];
                $virtual->insert($insert);
            }
        }
return 1;

    }
    public function card(Server $server, Virtual $virtual, $id){
        $this->data['servers'] = $server->where(['id' => $id])->get();
        $this->data['virtuals'] = $virtual->where(['id_server' => $id])->get();
        $this->data['id'] = $id;
        return view('list.server.card',$this->data);

    }
    public function add_virtual(Request $request){
        $itempost = $request->input();
        $this->data['id'] = $itempost['id'];
        return view('list.server.page_add_1', $this->data);
    }
    public function delete_virtual(Request $request, Virtual $virtual){
        $itempost = $request->input();
        $name = $virtual->select('name')->where(['id' => $itempost['id']])->firstOrFail();
        $virtual->where(['id' => $itempost['id']])->delete();

        //return dd($itempost['id']);
        //history
        $data = $name->name;
        $plus = $itempost['id_server'];
        $id_user = $itempost['id_user'];

        $this->history( $id_user ,'delete', 'virtual', $data , $plus);
    }
    public function delete_server(Request $request, Server $server){
        $itempost = $request->input();
        $name = $server->select('name')->where(['id' => $itempost['id']])->firstOrFail();
        $server->where(['id' => $itempost['id']])->delete();

        //return dd($itempost['id']);
        //history
        $data = $name->name;
        $plus = $itempost['id_server'];
        $id_user = $itempost['id_user'];

        $this->history( $id_user ,'delete', 'server', $data , $plus);
    }

    public function edit_virtual_page(Request $request, Virtual $virtual){

        $itempost = $request->input();
        $this->data['virtuals'] = $virtual->where(['id' => $itempost['id']])->firstOrFail();

        return view('list.server.edit_virtual_page', $this->data);
    }

    public function edit_virtual(Request $request, Virtual $virtual){

        $itempost = $request->input();
        $id_user = $itempost['id_user'];
        $id_virtual = $itempost['id_virtual'];
        unset($itempost['id_user']);
        unset($itempost['id_virtual']);
        unset($itempost['_token']);

        $itempost += [ 'updated_at' => date("Y-m-j H:i:s"),];
        $virtual->where(['id' => $id_virtual])->update($itempost);
        $data = $id_virtual;
        $this->history( $id_user ,'update', 'virtual', $data );

    }
    public function edit_server(Request $request, Server $server){

        $itempost = $request->input();
        $id_user = $itempost['id_user'];
        $id = $itempost['id'];
        unset($itempost['id_user']);
        unset($itempost['id']);
        unset($itempost['_token']);

        $itempost += [ 'updated_at' => date("Y-m-j H:i:s"),];
        $server->where(['id' => $id])->update($itempost);


        $this->history( $id_user ,'update', 'server', $id );


    }
    public function edit_server_page(Request $request, Server $server){

        $itempost = $request->input();
        $this->data['servers'] = $server->where(['id' => $itempost['id']])->firstOrFail();

        return view('list.server.edit_server_page', $this->data);
    }

    public function page_move(Virtual $virtual, Server $server){

        $this->data['virtuals'] = $virtual->get();
        $this->data['servers'] = $server->get();
        return view('list.server.page_move', $this->data);
    }

    public function moving(Request $request, Virtual $virtual){

        $itempost = $request->input();
        $virtual->where(['id' => $itempost['id_virtual']])->update([ 'id_server' => $itempost['id_server']]);

        //history

        $this->history( $itempost['id_user'] ,'moving', 'virtual', $itempost['id_virtual'] );

    }
}
