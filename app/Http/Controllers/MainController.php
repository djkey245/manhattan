<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Blog;
use App\Gallery;
use App\Project;
use App\Slider;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class MainController extends Controller
{
    public function __construct(Menu $menuModel)
    {
        $this->data = [];
        $this->data['menu']['left'] = $menuModel->getLeftMenu();
        $this->data['menu']['right'] = $menuModel->getRightMenu();

    }
}
