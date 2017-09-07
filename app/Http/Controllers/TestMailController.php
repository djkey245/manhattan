<?php

namespace App\Http\Controllers;

use App\Test;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;




class TestMailController extends Controller
{

    public function index(Test $test, User $user){
        $this->data['users1'] = $user->where(['id' => 17])->get();
        $this->data['users2'] = $user->where(['id' => 27])->get();
        $this->data['tests'] = $test->latest('date')->get();



        return view('list.admin.index', $this->data);
    }

    public function save(Test $test, User $user, Request $request){
        $itempost = $request->input();
        $data['time'] = $itempost['time'];
        $data['comment'] = $itempost['comment'];
        $data['date'] = date("Y-m-j");
        $data['id_user'] = $itempost['user'];

        $test->insert($data) or  die("Error");
        /*$this->data['users1'] = $user->where(['id' => 17])->get();
        $this->data['users2'] = $user->where(['id' => 27])->get();
        $this->data['tests'] = $test->oldest('date')->get();
        return view('list.admin.index', $this->data);*/
    }




















    public function test(){
        $data = [
            "jsonrpc" => "2.0",
            "method" => "user.login",
            "id" => "1",
            "auth" => null,
            "params" => [
                "user" => "Dimon",
                "password" => "z1x2c3v4",
            ]

        ];
        $data_string = json_encode($data);



        $zab = curl_init('http://192.168.0.100/zabbix/api_jsonrpc.php');
        curl_setopt($zab, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($zab, CURLOPT_POSTFIELDS, $data_string);

        curl_setopt($zab, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($zab, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json-rpc',
                'Content-Length: ' . strlen($data_string))
        );
        $result = curl_exec($zab);
        $result = json_decode($result);

        $serv = [
            "jsonrpc" => "2.0",
            "method" => "history.get",
            "id" => "1",
            "auth" => $result->result,
            "params" => [
                "output" => "extend",
                "history" => 4,
                "hostids" => "10962",
                "itemids" => "38307",
                "sorfield" => "clock",
                "sortorder" => "DESC",
                "limit" =>  -1
            ]


        ];

        $serv_string = json_encode($serv);

        $zab = curl_init('http://192.168.0.100/zabbix/api_jsonrpc.php');
        curl_setopt($zab, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($zab, CURLOPT_POSTFIELDS, $serv_string);

        curl_setopt($zab, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($zab, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json-rpc',
                'Content-Length: ' . strlen($serv_string))
        );
        $result1 = curl_exec($zab);
        $result1 = json_decode($result1);
        $rs = $result1->result;
        $a = count($rs);
        //dd($rs[($a-1)]->value);
        dd($result->result);
    }
}
