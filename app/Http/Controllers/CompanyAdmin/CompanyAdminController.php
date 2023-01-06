<?php

namespace App\Http\Controllers\CompanyAdmin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\CompanyAdmin;
use Illuminate\Http\Request;

class CompanyAdminController extends Controller
{
   public function index(){
       return view('CompanyAdmin.dashboard');
   }
}
