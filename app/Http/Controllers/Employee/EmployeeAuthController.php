<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Company;
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

    protected $bb;
    public function register(Request $request){
        // validate
        $request->validate([
            'name'=>'required',
            'email' => 'required|unique:users|email',
            'password'=>'required|confirmed'
        ]);

        $this->bb = Company::select('id')->where('code', $request->ccname)->first();


        // save in users table

        if($this->bb){
            $this->bb = $this->bb->id;
            User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=> \Hash::make($request->password),
                'role' => '0',
                'code' => $request->ccname,
                'position' => $request->position,
                'office' => $request->office,
                'age' => $request->age,
            ]);

            if(\Auth::attempt($request->only('email','password'))){
                session()->flash('Add', 'Registered Successfully.');
                return view('Employee.dashboard');
            }

        }
        // login user here

        session()->flash('Error', 'Company ID is not valid.');
        return redirect('Employeeregister');


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
