<?php

namespace App\Http\Controllers;

use App\Models\course;
use App\Models\User;
use Database\Seeders\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->role == '1') {
            $counter_of_courses_scheduled = 0;
            $emp = User::where('code', '=', auth()->user()->code)->where('role', '=', '0')->get();
            if ($emp) {
                foreach ($emp as $e) {
                    $temp = DB::table('course_taken_by')->where('employee_id', '=', $e->id)->get();
                    if ($temp) {
                        foreach ($temp as $t) {
                            $counter_of_courses_scheduled++;
                        }
                    }
                }
            }
            $invoices = 0;
            $vat = 0;
            $rows = User::where('code', '=', auth()->user()->code)->where('role', '=', '0')->get();
            if ($rows) {
                foreach ($rows as $r) {
                    $te = DB::table('course_taken_by')->where('employee_id', '=', $r->id)->get();
                    if ($te) {
                        foreach ($te as $to) {
                            $uu = DB::table('courses')->where('id', '=', $to->course_id)->get()->first();
                            $vat = $vat + 0.15 * $uu->price;
                            $invoices = $invoices + $uu->price;
                        }
                    }
                }
            }
            $vat = $invoices + $vat;
            $invoices = number_format($invoices, 2);
            $vat = number_format($vat, 2);
            $data_requested = DB::table('course_requested')->where('admin_id', '=', Auth::user()->id)->get()->count();

            $progTotal = 0;
            $numOfEmp = 0;
            $my_employees = User::where('code', '=', auth()->user()->code)->where('role', '=', '0')->get();
            if ($my_employees) {
                foreach ($my_employees as $e) {
                    $te = DB::table('course_taken_by')->where('employee_id', '=', $e->id)->get();
                    if ($te) {
                        foreach ($te as $to) {
                            $numOfEmp++;
                            $progTotal = $progTotal + $to->progress;
                        }
                    }
                }
            }
            if ($numOfEmp) {
                $calcProg = ($progTotal / $numOfEmp);
            } else {
                $calcProg = 0;
            }
            $totemp = User::where('code', '=', auth()->user()->code)->where('role', '=', '0')->get()->count();


            $empToChart = User::where('code', '=', auth()->user()->code)->where('role', '=', '0')->get();
            $jan = 0; // 1
            $feb = 0; // 2
            $mar = 0; // 3
            $apr = 0; // 4
            $may = 0; // 5
            $jun = 0; // 6
            $jul = 0; // 7
            $aug = 0; // 8
            $sep = 0; // 9
            $oct = 0; // 10
            $nov = 0; // 11
            $dec = 0; // 12
            if ($empToChart) {
                foreach ($empToChart as $e) {
                    $te = DB::table('course_taken_by')->where('employee_id', '=', $e->id)->get();
                    if ($te) {
                        foreach ($te as $to) {
                            $month = date('m', strtotime($to->created_at));
                            $toto = DB::table('courses')->where('id', $to->course_id)->get()->first();
                            switch ($month) {
                                case(01):
                                    $jan = $jan + $toto->price;
                                    break;
                                case(02):
                                    $feb = $feb + $toto->price;
                                    break;
                                case(03):
                                    $mar = $mar + $toto->price;
                                    break;
                                case(04):
                                    $apr = $apr + $toto->price;
                                    break;
                                case(05):
                                    $may = $may + $toto->price;
                                    break;
                                case(06):
                                    $jun = $jun + $toto->price;
                                    break;
                                case(07):
                                    $jul = $jul + $toto->price;
                                    break;
                                case(8):
                                    $aug = $aug + $toto->price;
                                    break;
                                case(9):
                                    $sep = $sep + $toto->price;
                                    break;
                                case(10):
                                    $oct = $oct + $toto->price;
                                    break;
                                case(11):
                                    $nov = $nov + $toto->price;
                                    break;
                                case(12):
                                    $dec = $dec + $toto->price;
                                    break;
                                default:
                                    break;
                            }
                        }
                    }
                }
            }

            $empToPie = User::where('code', '=', auth()->user()->code)->where('role', '=', '0')->get();
            $accepted_req = 0;
            $rejected_req = 0;
            $no_action = 0;

            if ($empToPie) {
                foreach ($empToPie as $ep) {
                    $te = DB::table('course_requested')->where('admin_id', '=', Auth::user()->id)->get();
                    if ($te) {
                        foreach ($te as $to) {
                            $status = $to->accepted;
                            switch ($status) {
                                case(0):
                                    $no_action++;
                                    break;
                                case(1):
                                    $accepted_req++;
                                    break;
                                case(2):
                                    $rejected_req++;
                                    break;
                                default:
                                    break;
                            }
                        }
                    }
                }
            }
            return view('CompanyAdmin.dashboard', compact('invoices', 'counter_of_courses_scheduled', 'vat', 'data_requested', 'calcProg', 'totemp', 'jan', 'feb', 'mar', 'apr', 'may', 'jun', 'jul', 'aug', 'sep', 'oct', 'nov', 'dec', 'accepted_req', 'rejected_req', 'no_action'));
        }
        if(Auth::user()->role == '0'){
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
        if(Auth::user()->role == '2'){
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

}

}
