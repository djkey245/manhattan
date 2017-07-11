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
        $this->data['name'] = $itempost['name'];
        $this->data['ip'] = $itempost['ip'];

        $this->data['vnc'] = $itempost['vnc'];
        $this->data['rdp'] = $itempost['rdp'];
        $itempost += [ 'created_at' => date("Y-m-j H:i:s"),];
        unset($itempost['_token']);
        $server->insert($itempost);
        $id = $server->select('id')->where(['name' => $itempost['name'],])->firstOrFail();
        $this->data['id'] = $id;
        return view('list.server.page_add_1', $this->data);
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
        return view('list.server.card',$this->data);

    }
}
