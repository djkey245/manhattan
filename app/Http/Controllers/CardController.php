<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Menus;
use App\Comments;
class CardController extends Controller
{
    public function comment_page_add($id){

        $this->data['id'] = $id;

        return view('list.card.comment', $this->data);
    }
    public function comment_add(Request $request, Comments $comments){

        $com = $request->input();
        unset($com['_token']);
        $com += ['data' => date("Y-m-j H:i:s")];
        $comments->insert($com);


    }
}
