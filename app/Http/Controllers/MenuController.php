<?php

namespace App\Http\Controllers;

use App\Peoples;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Menus;
class MenuController extends Controller
{
    public function index(Menus $menu){

        $this->data['items'] = $menu->orderBy('actual', 'asc')->get();
        return view('list.menu', $this->data);
    }
    public function page_add(){


        return view('list.menu.page_add');
    }
    public function page_edit($name_eng, Menus $menu){

        $this->data['items'] = $menu->column_name($name_eng);
        return view('list.menu.page_edit', $this->data);
    }

    public function add(Request $request,Menus $menu,Peoples $peoples){
        $itempost = $request->input();
        unset($itempost['_token']);
        $name_eng = $itempost['name_eng'];
        $itempost += ['created_at' => date("Y-m-j H:i:s"), 'menu_id' => 1];

        $menu->insert($itempost);
        if($itempost['type'] == 'text'){
            $peoples->add_column('string',$name_eng);
        }
        if($itempost['type'] == 'textarea'){
            $peoples->add_column('longtext',$name_eng);
        }
        if($itempost['type'] == 'number'){
            $peoples->add_column('integer',$name_eng);
        }
        if($itempost['type'] == 'password'){
            $peoples->add_column('string',$name_eng);
        }
        if($itempost['type'] == 'select'){
            $peoples->add_column('string',$name_eng);
        }
        if($itempost['type'] == 'date'){
            $peoples->add_column('date',$name_eng);
        }
        if($itempost['type'] == 'email'){
            $peoples->add_column('string',$name_eng);
        }
    }
    public function delete($id,Menus $menu, Peoples $people){
        $items = $menu->column_id($id);
        $name = $items['0']->name_eng;
        $people->delete_column($name);
        $menu->delete_item($id);
    }
    public function edit(Request $request, Menus $menus){
        $itempost = $request->input();
        $id = $itempost['id'];
        unset($itempost['id']);
        unset($itempost['_token']);
        $itempost += ['updated_at' => date("Y-m-j H:i:s")];
        $menus->where(['id' => $id])->update($itempost);

    }


}
