<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class TestController extends Controller
{
    public function index(){
        require('Class/RouterosAPI.php');
        $API = new RouterosAPI();

        $API->debug = false;

        if($API->connect('192.168.11.16', 'admin', 'mikrotikcore')){
            //$API->write('/caps-man/registration-table/print');
            $API->write('/ip/hotspot/active/print');
            $READ = $API->read(false);
            $hotspots = $API->parseResponse($READ);
            $API->write("/caps-man/registration-table/print");
            $cap =  $API->read(false);
            $cap_users = $API->parseResponse($cap);
            //print_r($cap_users);
            //print_r($hotspots);

            echo '<br>';
            foreach ($hotspots as $hotspot){


                foreach ($cap_users as $cap_user){
                    if($cap_user['mac-address'] == $hotspot['mac-address'])        {

                        echo $hotspot['mac-address'].'  '.$hotspot['address'].'  '.$hotspot['user'].'  '.$cap_user['interface'].'  '.$cap_user['uptime'].'  '.$cap_user['bytes'];
                        echo '<br>';
                    }
                    else{

                    }
                }
            }

            $API->disconnect();
        }
    }

}
