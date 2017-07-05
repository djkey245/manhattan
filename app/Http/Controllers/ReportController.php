<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Peoples;
use App\Http\Requests;

class ReportController extends Controller
{
    public function index(){



        return view('list.reports');

    }

    public function page_add(Peoples $peoples, $office){

            $this->data['peoples'] = $peoples->select('id','name','surname')->where(['office' => $office])->get();



            return view('list.report.page_add', $this->data);
    }
}
