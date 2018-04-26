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

    public function addPopup($id){

        return view('list.documentation.add_article_popup', compact('id'));
    }

    public function store(Request $request)
    {
        Documentation::create(['title' => $request->title, 'text' => $request->text,
            'documentationCategory_id' => $request->documentationCategory_id, 'user_id' => $request->user_id]);
        return redirect()->route('documentation.index');
    }
    public function upload(Request $request)
    {
        $path =  public_path().'\images\\';
        $file = $request->file('file');
        $filename = str_random(20) .'.' . $file->getClientOriginalExtension() ?: 'png';
        $img = Image::make($file);
        $img->save($path . $filename);
        echo '/images/'.$filename;
    }

    public function articleShow(Documentation $documentation, $id){
        $article = $documentation->where('id',$id)->firstOrFail();
        return view('list.documentation.article', compact('article'));
    }
}
