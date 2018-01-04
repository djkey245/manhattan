<?php

namespace App\Console\Commands;

use App\Http\Controllers\Clases\RouterosAPI;
use App\Peoples;
use App\Wifi;
use Carbon\Carbon;
use Illuminate\Console\Command;

class WIFIConsole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wifi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'wifi description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Wifi $wife)
    {
        require('Add/RouterosAPI.php');
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
            $time = '';
            foreach ($hotspots as $hotspot){


                foreach ($cap_users as $cap_user){
                    if($cap_user['mac-address'] == $hotspot['mac-address'])        {
                        list($other, $emp)  = explode('ms', $cap_user['uptime']);
                        list($other, $Msec) = explode('s', $other);
                        if(!empty($other)){
                            if(strripos($other, 'm')){
                                list($other, $sec) = explode('m', $other);
                                $time = '00:00:'.$sec;
                                if(!empty($other)){
                                    if(strripos($other, 'h')) {

                                        list($otherH, $min) = explode('h', $other);
                                        if (empty($min)) {
                                            $time = '00:' . $min . ':' . $sec;
                                        }
                                        else {
                                            $time = ''.$otherH . ':' . $min . ':' . $sec;
                                        }
                                    }
                                    else{
                                        $time = '00:' . $other . ':' . $sec;
                                    }
                                }
                            }

                        }
                        $time_at = Carbon::now();
                        $wife->insert(['user' => $hotspot['user'], 'cap' => $cap_user['interface'], 'time' => $time, 'date_at' => Carbon::now(), 'time_at' => $time_at->format('H:i:s')]);

                    }
                    else{

                    }
                }
            }


            $API->disconnect();
        }

    }
}
