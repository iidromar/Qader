<?php

namespace App\Http\Controllers\InstitAdmin;

use App\Http\Controllers\Controller;
use App\Models\course;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            session()->flash('Add', 'Login Successfully.');

                $courses = Course::where('creator', Auth::user()->id)->get();
                $maid = 0;
                if($courses){
                    $maid = $courses->count();
                }else{
                    $maid = 0;
                }
                $earnings = 0;
                $no_action = 0;
                $approved = 0;
                $rejected = 0;
                $quizzes = 0;
                $prices = 0;
                $numOfTakens = 0;
                $counterArray =0;
                $countAll = [];
                if($courses){
                    foreach ($courses as $c){
                        $prices = $prices + $c->price;
                        $taken = DB::table('course_taken_by')->where('course_id', $c->id)->get();
                        if($taken){
                            foreach ($taken as $t){
                                $earnings = $earnings + $c->price;
                                $numOfTakens++;
                            }
                            $countAll[$counterArray] = $numOfTakens;
                            $quizzes = $quizzes + DB::table('quizzes')->where('course_id', $c->id)->get()->count();
                        }
                        $counterArray++;
                        $numOfTakens = 0;
                    }
                }

                $req = DB::table('course_requested')->where('instit_id', Auth::user()->id)->get();
                foreach ($req as $r){
                    $status = $r->accepted;
                    switch ($status){
                        case('0'):
                            $no_action++;
                            break;
                        case('1'):
                            $approved++;
                            break;
                        case('2'):
                            $rejected++;
                            break;
                        default:
                            break;
                    }

                }
                $earnings = number_format($earnings, 2);

                $topFive = $courses->sortByDesc('price')->take(5);

                $topCourses = $courses->take(8);

                return view('InstitAdmin.dashboard', compact('earnings', 'maid', 'no_action', 'approved', 'rejected', 'quizzes', 'topFive', 'prices', 'topCourses', 'countAll'));

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
            session()->flash('Add', 'Registered Successfully.');

            $courses = Course::where('creator', Auth::user()->id)->get();
            $maid = 0;
            if($courses){
                $maid = $courses->count();
            }else{
                $maid = 0;
            }
            $earnings = 0;
            $no_action = 0;
            $approved = 0;
            $rejected = 0;
            $quizzes = 0;
            $prices = 0;
            $numOfTakens = 0;
            $counterArray =0;
            $countAll = [];
            if($courses){
                foreach ($courses as $c){
                    $prices = $prices + $c->price;
                    $taken = DB::table('course_taken_by')->where('course_id', $c->id)->get();
                    if($taken){
                        foreach ($taken as $t){
                            $earnings = $earnings + $c->price;
                            $numOfTakens++;
                        }
                        $countAll[$counterArray] = $numOfTakens;
                        $quizzes = $quizzes + DB::table('quizzes')->where('course_id', $c->id)->get()->count();
                    }
                    $counterArray++;
                    $numOfTakens = 0;
                }
            }

            $req = DB::table('course_requested')->where('instit_id', Auth::user()->id)->get();
            foreach ($req as $r){
                $status = $r->accepted;
                switch ($status){
                    case('0'):
                        $no_action++;
                        break;
                    case('1'):
                        $approved++;
                        break;
                    case('2'):
                        $rejected++;
                        break;
                    default:
                        break;
                }

            }
            $earnings = number_format($earnings, 2);

            $topFive = $courses->sortByDesc('price')->take(5);

            $topCourses = $courses->take(8);

            return view('InstitAdmin.dashboard', compact('earnings', 'maid', 'no_action', 'approved', 'rejected', 'quizzes', 'topFive', 'prices', 'topCourses', 'countAll'));

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
