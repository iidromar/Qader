<?php

namespace App\Http\Controllers\CompanyAdmin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\CompanyAdmin;
use App\Models\Company;
use App\Models\User;
use App\Models\Course;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class CompanyAdminController extends Controller
{

   public function index(){
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
                       $vat = $vat + (0.15 * $uu->price);
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
   public function all_employees(){
       $emp = User::where('code', '=', auth()->user()->code)->where('role', '=', '0')->get();
       $comp = Company::where('code', '=', auth()->user()->code)->get()->first();
       return view('CompanyAdmin.company_employees', compact('emp', 'comp'));
   }
   public function employee_progress($id=null){
       $employee = User::find($id);
       $temp = DB::table('course_taken_by')->where('employee_id', '=', $id)->get();
       $related = new Collection();
       $time = [];
       $progress = [];
       $deadline = [];
       $counter = 0;

       if($temp){
           foreach ($temp as $t){
               $course = Course::where('id', '=', $t->course_id)->get();
               $related = $related->merge($course);
               $time[$counter] = $t->created_at;
               $progress[$counter] = $t->progress;
               $deadline[$counter] = $t->deadline;
               $counter = $counter +1;

           }
           return view('CompanyAdmin.employee_progress', compact('related', 'employee', 'time', 'progress', 'deadline'));
       }

       return view('CompanyAdmin.employee_progress');
   }
   public function give_training($id=null){
       $employee = User::find($id);
       $options = Course::getPossibleCategories();
       return view('CompanyAdmin.give_training', compact('employee', 'options'));

   }
   public function give_items($cat=null){
       $courses = DB::table('courses')->where('category', $cat)->pluck('name', 'id');
       return json_encode($courses);
   }
   public function give_price($item=null){
       $price = DB::table('courses')->where('name', $item)->pluck('price', 'id');
       return json_encode($price);
   }
   public function new_training_req(Request $request, $id=null){
       $rr = $request->all();
       $c = DB::table('courses')->where('name', $request->hiddenOneValue)->first();
       DB::table('course_taken_by')->insert(
          array('employee_id' => $id, 'course_id' => $c->id, 'progress' => 0, 'deadline' => $request->deadline_Date)
       );
       session()->flash('Add', 'Training has been assigned to the employee successfully.');
       $employee = User::find($id);
       $options = Course::getPossibleCategories();
        return view('CompanyAdmin.give_training', compact('employee', 'options'));
   }
   public function give_brief($item=null){
       $brief = DB::table('courses')->where('name', $item)->pluck('description', 'id');
       return json_encode($brief);

   }

    public function setCalenderIndex(){
        $employees = User::where('code', '=', auth()->user()->code)->where('role', '=', '0')->get();
        return view('CompanyAdmin.setCalendar', compact('employees'));
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required|string'
        ]);

        $booking = booking::create([
            'employee_id'=>$request->employee_id,
            'title' => $request->title,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);


        return redirect('/CompanyEmployees');
    }
}
