<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Peoples;
use App\User;
use App\Report;
use App\Http\Requests;

class ReportController extends Controller
{
    public function index(){



        return view('list.reports');

    }

    public function page_add_1(Peoples $peoples, $office, Request $request){

            $this->data['peoples'] = $peoples->select('id','name','surname','profession')->where(['office' => $office])->get();
            $itempost = $request->input();
            $date_up = $itempost['date_up'];
            $date_down = $itempost['date_down'];
            $this->data['date_up'] = $date_up;
            $this->data['date_down'] = $date_down;
            $this->data['office'] = $office;

            return view('list.report.page_add_1', $this->data);
    }
    public function page_add(){




    return view('list.report.page_add');
}
    public function report_add(Request $request,Report $report){

        $itempost = $request->input();

        unset($itempost['_token']);
        return print_r($itempost);
        $report->insert($itempost);

    }
    public function report_add_next(Request $request,Report $report){
        $itempost = $request->input();
        $date_up = $itempost['date_up'];
        $date_down = $itempost['date_down'];
        $office = $itempost['office'];
        $this->data['date_up'] = $date_up;
        $this->data['date_down'] = $date_down;
        $this->data['office'] = $office;
        unset($itempost['_token']);
        $report->insert($itempost);
        return view('list.report.page_add_1', $this->data);

    }



}
