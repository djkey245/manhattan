<?php

namespace App\Http\Controllers;

use App\Contracts;
use App\Peoples;
use Illuminate\Http\Request;
use App\Server;
use App\Virtual;
use App\Http\Requests;

class ServerController extends Controller
{

    public function index(Server $server,Virtual $virtual){
        $this->data['servers'] = $server->get();
        $this->data['virtuals'] = $virtual->get();
        $virtualWithoutServer = [] ;
        foreach ($virtual->get() as $virt){
            if(Server::find($virt->id_server)){

            }
            else{
                array_push($virtualWithoutServer, $virt->id);
            }

        }
        $this->data['virtualWithoutServer'] = $virtualWithoutServer;
        return view('list.server',$this->data);
    }
    public function without(Virtual $virtual, Contracts $contracts, Peoples $peoples){
        $virtualWithoutServer = [] ;
        $this->data['virtuals'] =[];
        $this->data['contracts'] = $contracts->get();
        $this->data['peoples'] = $peoples->get();

        foreach ($virtual->get() as $virt){
            if(Server::find($virt->id_server)){

            }
            else{
                array_push($this->data['virtuals'], $virt);
            }

        }
        $this->data['virtualWithoutServer'] = $virtualWithoutServer;
        return view('list.server.without',$this->data);

    }


    public function page_add_rdp(){
        $this->data['type'] = 'rdp';
        return view('list.server.page_add', $this->data);
    }
    public function page_add_vrt(){
        $this->data['type'] = 'vrt';
        return view('list.server.page_add', $this->data);
    }
    public function page_add_1(Request $request, Server $server){
        $itempost = $request->input();

        if(empty($itempost['name'])){
            $this->data['error'] = 'Не введено ім’я сервера!';
            return view('list.server.page_add', $this->data);
        }
        else{
            if($itempost['purpose'] == 'rdp') {
                $this->data['name'] = $itempost['name'];
                $this->data['ip'] = $itempost['ip'];
                $this->data['vnc'] = $itempost['vnc'];
                $this->data['rdp'] = $itempost['rdp'];
                $id_user = $itempost['id_user']; //history
                $itempost += ['created_at' => date("Y-m-j H:i:s"),];
                unset($itempost['_token']);
                unset($itempost['id_user']);
                $server->insert($itempost);
                $id = $server->select('id')->where(['name' => $itwhereempost['name'],])->firstOrFail();
                $this->data['id'] = $id->id;

                //history
                $data = $id->id;
                $this->history($id_user, 'create', 'server', $data);


                return view('list.server.page_add_1', $this->data);
            }
            elseif($itempost['purpose'] == 'vrt') {
                $this->data['name'] = $itempost['name'];
                $this->data['ip'] = $itempost['ip'];
                $this->data['vnc'] = $itempost['vnc'];
                $this->data['rdp'] = $itempost['rdp'];
                $this->data['login'] = $itempost['login'];
                $id_user = $itempost['id_user']; //history
                $itempost += ['created_at' => date("Y-m-j H:i:s"),];
                unset($itempost['_token']);
                unset($itempost['id_user']);
                $server->insert($itempost);
                $id = $server->select('id')->where(['name' => $itempost['name'],])->firstOrFail();
                $this->data['id'] = $id->id;

                //history
                $data = $id->id;
                $this->history($id_user, 'create', 'server', $data);


                return view('list.server.page_add_1', $this->data);
            }
        }
    }
    public function save(Request $request, Virtual $virtual){
        $itempost = $request->input();
        $insert = $itempost;
        $id_user = $itempost['id_user']; //history
        $data = $itempost['id_serv']; //history
        unset($insert['_token']);
        unset($insert['vrt']);
        unset($insert['id_serv']);
        unset($insert['id_user']);
        $virtuals = explode(';', $itempost['vrt']);
        $items = [];
        $count = count($virtuals);
        unset($virtuals[$count-1]);
        for($i = 0; $i < $count-1; $i++) {
            $items = explode(',', $virtuals[$i]);
            if(!empty($items[0]) or !empty($items[1]) or !empty($items[2])) {
                $insert = ['name' => $items[0],];
                $insert += ['ip' => $items[1],];
                $insert += ['lp' => $items[2],];
                $insert += ['os' => $items[3],];
                $insert += ['purpose' => $items[4],];
                $insert += ['id_server' => $itempost['id_serv'],];
                $virtual->insert($insert);


            }
        }


        //history
        $this->history( $id_user ,'create', 'virtual', $data);
return 1;

    }
    public function card(Server $server, Virtual $virtual, $id, Peoples $peoples, Contracts $contracts){
        $this->data['servers'] = $server->where(['id' => $id])->get();
        $this->data['peoples'] = $peoples->get();
        $this->data['contracts'] = $contracts->get();
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

        $this->history( $itempost['id_user'] ,'moving', 'virtual', $itempost['id_virtual'] , $itempost['id_server']);

    }

    public function search(Request $request, Virtual $virtual, Server $server){

        $word = $request->input('referal');
        $word = htmlspecialchars(stripcslashes(trim($word)));
        $id = [];
        $searches = $virtual->select('id')->where('ip', 'LIKE', '%' . $word . '%')->get();//
            foreach ($searches as $search) {

                if (!empty($search)) {
                    array_push($id, $search->id);
                }
            }
        $srchs = $virtual->select('id')->where('name', 'LIKE', '%' . $word . '%')->get();
        foreach ($srchs as $srch) {

            if (!empty($srch)) {
                array_push($id, $srch->id);
            }
        }
        $this->data['servers'] = $server->get();
        $this->data['virtuals'] = $virtual->get();
        $this->data['ids'] = $id;
        return view('list.server',$this->data);
    }
}
