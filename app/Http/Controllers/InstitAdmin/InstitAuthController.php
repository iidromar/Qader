<?php

namespace App\Http\Controllers\InstitAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class InstitAuthController extends Controller
{
    public function index()
    {
        return view('InstitAdmin.login');
    }

    public function login(Request $request){
        // validate data
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        // login code

        if(\Auth::attempt($request->only('email','password'))){
           // if(Auth::user()->role == '2'){
                return view('InstitAdmin.dashboard');
           // }
        }

        return redirect('Institlogin')->withError('Login details are not valid');

    }

    public function register_view()
    {
        return view('InstitAdmin.register');
    }

    public function register(Request $request){
        // validate
        $request->validate([
            'name'=>'required',
            'email' => 'required|unique:users|email',
            'password'=>'required|confirmed'
        ]);

        // save in users table

        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=> \Hash::make($request->password),
            'role' => '2',
            'code' => 0,
        ]);

        // login user here

        if(\Auth::attempt($request->only('email','password'))){
            return view('InstitAdmin.dashboard');
        }

        return redirect('Institregister')->withError('Error');


    }



    public function home(){
        return view('InstitAdmin.dashboard');
    }

    public function logout(){
        \Session::flush();
        \Auth::logout();
        return redirect('');
    }

}
