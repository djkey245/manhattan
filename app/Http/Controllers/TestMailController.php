<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use Google_Client;
use Google_Service_People;
use App\Http\Requests;

class TestMailController extends Controller
{
        public function test(){

            $this->data['json'] = response()->json([

                'jsonrpc' => '2.0',
                'method' => 'user.login',
                'params' => [
                    'user' => 'Dimon',
                    'password' => 'z1x2c3v4',
                ],
                'id' => 1,
                'auth'=> null


            ]);
            return view('list.tests', $this->data);
        }
}
