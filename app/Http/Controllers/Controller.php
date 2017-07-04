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
        $log = ['id_user' => $id_user, 'event' => $event, 'model' => $model, 'data' => $data, 'date' => $date ];
        History::insert($log);


    }
}
