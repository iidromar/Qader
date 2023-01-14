<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\course;
use App\Models\User;
use Illuminate\Http\Request;

class testController extends Controller
{
    public function test(){
        $c = Company::find(1);
        return $c->admin;
    }
}
