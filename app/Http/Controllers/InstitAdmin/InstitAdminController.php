<?php

namespace App\Http\Controllers\InstitAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InstitAdminController extends Controller
{
    public function index(){
        return view('InstitAdmin.index');
    }
}
