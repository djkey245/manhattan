<?php

namespace App\Http\Controllers;

use App\Comments;
use App\History;
use App\Http\Requests;
use App\Important;
use App\Menus;
use App\Peoples;
use App\Server;
use App\Virtual;
use Illuminate\Http\Request;
use App\User;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user, History $history, Peoples $peoples, Menus $menus, Comments $comments, Server $server, Virtual $virtual, Important $important)
    {
        $this->data['users'] = $user->perm();
        $this->data['history'] = $history->/*where(['model' => ])->*/orderBy('id', 'desc')->paginate(10);
        $this->data['menus'] = $menus->get();
        $this->data['peoples'] = $peoples->get();
        $this->data['comments'] = $comments->get();
        $this->data['servers'] = $server->get();
        $this->data['virtuals'] = $virtual->get();
        $peopless = $peoples->where(['active' => 'Так'])->get();
        $importants = [];
        $imp_lists = $important->orderBy('actual', 'desc')->get();
        foreach ($imp_lists as $imp_list){
            $items = [];
            $importants[($imp_list->id)] = [];
            foreach ($peopless as $people){

                if(empty($people->{$imp_list->name})){


                    array_push($items, $people->id);
                }


            }
            array_push($importants[($imp_list->id)], $items);

        }
        $this->data['importants'] = $important->orderBy('actual', 'desc')->get();
        $this->data['notactuals'] = $importants;
        return view('home' , $this->data);
    }
    public function other(Request $request, Peoples $peoples, Important $important){
        $itempost = $request->input();
        $peopless = $peoples->where(['active' => 'Так'])->get();
        $importants = [];
        $imp_lists = $important->where(['id' => $itempost['id']])->firstOrFail();
            foreach ($peopless as $people){

                if(empty($people->{$imp_lists->name})){


                    array_push($importants, $people->id);
                }


            }

        $this->data['peoples'] = $peoples->where(['active' => 'Так'])->get();
        $this->data['importants'] = $importants;
        //return dd($importants);
        return view('list.other', $this->data);
    }
}
