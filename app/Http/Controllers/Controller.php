<?php

namespace App\Http\Controllers;
use App\History;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;


    public function history($id_user, $event, $model, $data){


        $date = date("Y-m-j H:i:s");
        $id_data;
        if($event == 'insert') {
            foreach ($data as $item) {
                $id_data = $item['id'];
            }
        }
        else{
            $id_data = $data;
        }
        $log = ['id_user' => $id_user, 'event' => $event, 'model' => $model, 'data' => $id_data, 'date' => $date ];
        History::insert($log);


    }
}
