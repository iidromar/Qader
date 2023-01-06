<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AuthorizationController extends Controller
{
    public function index()
    {
        Gate::allows('isCompanyAdmin') ? Response::allow() : abort(403);


        // if (Gate::denies('isAdmin')) {
        //     dd('You are not admin!');
        // } else {
        //     dd('Admin Allowed');
        // }
    }
}
