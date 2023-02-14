<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            session()->flash('Add', 'Login Successfully.');

            $courses = DB::table('course_taken_by')->where('employee_id', Auth::user()->id)->get();
            $data = new Collection();
            $num_of_courses = 0;
            $progTotal = 0;
            $numOfEmp = 0;
            $calcProg = 0;
            $quizzes = 0;
            if ($courses){
                $num_of_courses = $courses->count();
                foreach ($courses as $c){
                    $temp = DB::table('courses')->where('id', $c->course_id)->get();
                    if ($temp){
                        $data = $data->merge($temp);
                    }
                }
                foreach ($courses as $to){
                    $numOfEmp++;
                    $progTotal = $progTotal + $to->progress;
                }
                $tt = DB::table('results')->where('user_id', Auth::user()->id)->get()->count();
            }
            if ($data){
                $data_displayed = $data->take(6);
            }
            if($numOfEmp){
                $calcProg = ($progTotal / $numOfEmp);
            }
            else{
                $calcProg = 0;
            }
            return view('Employee.dashboard', compact('data_displayed', 'num_of_courses', 'calcProg', 'tt'));

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

                $courses = DB::table('course_taken_by')->where('employee_id', Auth::user()->id)->get();
                $data = new Collection();
                $num_of_courses = 0;
                $progTotal = 0;
                $numOfEmp = 0;
                $calcProg = 0;
                $quizzes = 0;
                if ($courses){
                    $num_of_courses = $courses->count();
                    foreach ($courses as $c){
                        $temp = DB::table('courses')->where('id', $c->course_id)->get();
                        if ($temp){
                            $data = $data->merge($temp);
                        }
                    }
                    foreach ($courses as $to){
                        $numOfEmp++;
                        $progTotal = $progTotal + $to->progress;
                    }
                    $tt = DB::table('results')->where('user_id', Auth::user()->id)->get()->count();
                }
                if ($data){
                    $data_displayed = $data->take(6);
                }
                if($numOfEmp){
                    $calcProg = ($progTotal / $numOfEmp);
                }
                else{
                    $calcProg = 0;
                }
                return view('Employee.dashboard', compact('data_displayed', 'num_of_courses', 'calcProg', 'tt'));

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
