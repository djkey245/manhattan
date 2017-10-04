<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class OTRSAPIController extends Controller
{
    public function index(){
        require('Class/OTRSAPI.php');

    }
}
