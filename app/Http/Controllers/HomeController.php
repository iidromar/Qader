<?php

namespace App\Http\Controllers;

use App\Models\course;
use App\Models\User;
use Illuminate\Http\Request;
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
        $counter_of_courses_scheduled = 0;
        $emp = User::where('code', '=', auth()->user()->code)->where('role', '=', '0')->get();
        if($emp){
            foreach ($emp as $e){
                $temp = DB::table('course_taken_by')->where('employee_id', '=', $e->id)->get();
                if($temp){
                    foreach ($temp as $t){
                        $counter_of_courses_scheduled++;
                    }
                }
            }
        }
        $invoices = 0;
        $vat =0;
        $rows = User::where('code', '=', auth()->user()->code)->where('role', '=', '0')->get();
        if($rows){
            foreach ($rows as $r){
                $te = DB::table('course_taken_by')->where('employee_id', '=', $r->id)->get();
                if($te){
                    foreach ($te as $to){
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


        return view('CompanyAdmin.dashboard', compact( 'invoices', 'counter_of_courses_scheduled', 'vat'));
    }

}
