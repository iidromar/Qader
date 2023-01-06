<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;

class HomePageController extends Controller
{
    public function index(){
        return view('HomePage.index');
    }
}
