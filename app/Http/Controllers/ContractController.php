<?php

namespace App\Http\Controllers;

use App\Contracts;
use Illuminate\Http\Request;

use App\Http\Requests;

class ContractController extends Controller
{
    public function index(Contracts $contracts){

        $this->data['contracts'] = $contracts->get();
        return view('list.contracts', $this->data);
    }
}
