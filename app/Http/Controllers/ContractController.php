<?php

namespace App\Http\Controllers;

use App\Contracts;
use App\Virtual;
use Illuminate\Http\Request;

use App\Http\Requests;

class ContractController extends Controller
{
    public function index(Contracts $contracts){

        $this->data['contracts'] = $contracts->get();
        return view('list.contracts', $this->data);
    }
    public function add(Contracts $contracts, Request $request){
        $itempost = $request->input();
        unset($itempost['_token']);
        $itempost['created_at'] = date("Y-m-j H:i:s");
        $contracts->insert($itempost);
        return 0 ;
    }
    public function edit_page($id, Contracts $contracts){
        $this->data['contract'] = $contracts->where(['id' => $id])->firstOrFail();
        return view('list.contracts.edit_page', $this->data);
    }
    public function del($id, Contracts $contracts){
        $contracts->where(['id' => $id])->delete();
        return 0;
    }
    public function save(Contracts $contracts, Request $request){
        $itempost = $request->input();
        $id = $itempost['id'];
        unset($itempost['_token']);
        unset($itempost['id']);
        $itempost['updated_at'] = date("Y-m-j H:i:s");
        $contracts->where(['id' => $id])->update($itempost);
        return 0 ;
    }
    public function virtual(Request $request, Virtual $virtual){
        $item = $request->input();
        $virtual->where(['id' => $item['id_vrt']])->update(['contracts_id' => $item['id_contr'], 'updated_at' => date("Y-m-j H:i:s")]);
    }
}
