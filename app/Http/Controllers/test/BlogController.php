<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Blog;
class BlogController extends MainController
{
    public function index(Blog $blog)
    {
        $this->data['records'] = $blog->getActive();
        return view('blog.index', $this->data);
    }

    public function card($slug, Blog $blog)
    {
        $this->data['record'] = $blog->getBySlug($slug);
        return view('blog.card', $this->data);
    }
}
