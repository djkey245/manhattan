<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Peoples;
use App\User;
use App\Report;
use App\Http\Requests;

class ReportController extends Controller
{
    public function index(Peoples $peoples,Report $report, User $user){
        $this->data['peoples'] = $peoples->select('id','name','surname','office')->get();
        $this->data['users'] = $user->select('id','name','surname')->get();
        $this->data['reports'] = $report->orderBy('id', 'desc')->get();
        $reports_1 = $report->orderBy('id', 'asc')->get();
        $reports_id = [];
        $i = 0;
        if(empty($reports_1['0'])){

        }
        else{
            $date = $reports_1['0']->date_up;
            $office = $reports_1['0']->office;
        }


        foreach ($this->data['reports'] as $group_report){
            if($date == $group_report['date_up'] && $office == $group_report['office']){
                if(empty($reports_id[$i])){
                    $reports_id[$i] = $group_report['id'];
                }
                else{
                    $reports_id[$i] = $reports_id[$i].','.$group_report['id'];
                }
            }
            else{
                $i++;
                if(empty($reports_id[$i])){
                    $reports_id[$i] = $group_report['id'];
                }
                else{
                    $reports_id[$i] = $reports_id[$i].','.$group_report['id'];
                }
            }
            $office = $group_report['office'];
            $date = $group_report['date_up'];

        }
        $this->data['reports_id'] = $reports_id;

        return view('list.reports', $this->data);

    }

    public function page_add_1(Peoples $peoples, $office, Request $request){
            $this->data['office'] = $office;
            $this->data['peoples'] = $peoples->select('id','name','surname','profession')->where(['office' => $office])->get();
            $itempost = $request->input();
            $date_up = $itempost['date_up'];
            $date_down = $itempost['date_down'];
            $this->data['date_up'] = $date_up;
            $this->data['date_down'] = $date_down;


            return view('list.report.page_add_1', $this->data);
    }
    public function page_add(){




    return view('list.report.page_add');
}
    public function report_add(Request $request,Report $report){

        $itempost = $request->input();

        unset($itempost['_token']);

        $report->insert($itempost);
        $id_user =$itempost['id_user'];
        $data = $itempost['date_up'].' '.$itempost['office'];
        $this->history( $id_user ,'report', 'report', $data );

    return 1;
    }
    public function report_add_next(Peoples $peoples,Request $request,Report $report, $office){
        $itempost = $request->input();
        $date_up = $itempost['date_up'];
        $date_down = $itempost['date_down'];
        $office = $itempost['office'];
        $this->data['peoples'] = $peoples->select('id','name','surname','profession')->where(['office' => $office])->get();
        $this->data['date_up'] = $date_up;
        $this->data['date_down'] = $date_down;
        $this->data['office'] = $office;

        unset($itempost['_token']);

        $report->insert($itempost);


        return view('list.report.page_add_1', $this->data);

    }



}
