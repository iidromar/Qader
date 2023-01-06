<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class EmployeeAuthController extends Controller
{
    public function index()
    {
        return view('Employee.login');
    }

    public function login(Request $request){
        // validate data
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        // login code

        if(\Auth::attempt($request->only('email','password'))){
            return view('Employee.dashboard');
        }

        return redirect('Employeelogin')->withError('Login details are not valid');

    }

    public function register_view()
    {
        return view('Employee.register');
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
            'role' => '0',
        ]);

        // login user here

        if(\Auth::attempt($request->only('email','password'))){
            return view('Employee.dashboard');
        }

        return redirect('Employeeregister')->withError('Error');


    }



    public function home(){
        return view('Employee.dashboard');
    }

    public function logout(){
        \Session::flush();
        \Auth::logout();
        return redirect('');
    }

}
