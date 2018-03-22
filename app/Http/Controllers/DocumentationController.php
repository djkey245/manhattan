<?php

namespace App\Http\Controllers;

use App\Documentation;
use App\DocumentationCategory;
use Illuminate\Http\Request;

use App\Http\Requests;

class DocumentationController extends Controller
{
    public function viewDocumentationCategory(){
        return view('list.documentation');
    }
    public function addDocumentationCategory(Request $request, DocumentationCategory $category){
        $itempost = $request->input();
        unset($itempost['_token']);
        $category->insert($itempost);
        return view('list.documentation');

    }
    public function viewDocumentationList($id, Documentation $documentation){
        $this->data['id'] = $id;
        $this->data['articles'] = $documentation->where(['documentationCategory_id' => $id ])->get();

        return view('list.documentation.list', $this->data);
    }
}
