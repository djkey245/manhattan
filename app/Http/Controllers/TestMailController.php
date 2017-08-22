<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\Http\Controllers\ZabbixApiController;



class TestMailController extends Controller
{

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
        dd($rs[($a-1)]->value);
    }
}
