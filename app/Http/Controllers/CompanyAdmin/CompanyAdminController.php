<?php

namespace App\Http\Controllers\CompanyAdmin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\CompanyAdmin;
use App\Models\Company;
use App\Models\User;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\checkProgress;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


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
       $data_requested = DB::table('course_requested')->where('admin_id', '=', Auth::user()->id)->get()->count();

       $vat = $invoices + $vat;
       $invoices = number_format($invoices, 2);
       $vat = number_format($vat, 2);

       $progTotal = 0;
       $numOfEmp = 0;
       $my_employees = User::where('code', '=', auth()->user()->code)->where('role', '=', '0')->get();
       if($my_employees){
           foreach ($my_employees as $e){
               $te = DB::table('course_taken_by')->where('employee_id', '=', $e->id)->get();
               if($te){
                   foreach ($te as $to){
                       $numOfEmp++;
                       $progTotal = $progTotal + $to->progress;
                   }
               }
           }
       }
       if($numOfEmp){
           $calcProg = ($progTotal / $numOfEmp);
       }
       else{
           $calcProg = 0;
       }

       $totemp =  User::where('code', '=', auth()->user()->code)->where('role', '=', '0')->get()->count();

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
       if($empToChart){
           foreach ($empToChart as $e){
               $te = DB::table('course_taken_by')->where('employee_id', '=', $e->id)->get();
               if($te){
                   foreach ($te as $to){
                      $month = date('m', strtotime($to->created_at));
                       $toto = DB::table('courses')->where('id', $to->course_id)->get()->first();
                       switch ($month){
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

       if($empToPie) {
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

       return view('CompanyAdmin.dashboard', compact( 'invoices', 'counter_of_courses_scheduled', 'vat', 'data_requested', 'calcProg', 'totemp', 'jan', 'feb', 'mar', 'apr', 'may', 'jun', 'jul', 'aug', 'sep', 'oct', 'nov', 'dec', 'accepted_req', 'rejected_req', 'no_action'));
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
        $lesson=[];
        $progress = [];
        $deadline = [];
        $counter = 0;

        if($temp){
            foreach ($temp as $t){
                $course = Course::where('id', '=', $t->course_id)->get();
                $lessons=lesson::where('course_id' ,$t->course_id)->get();
                $prog=checkProgress::where('course_id' ,$t->course_id)->where('employee_id' , $id)->get();
                $related = $related->merge($course);
                $time[$counter] = $t->created_at;
                $lesson[$counter] = count($lessons);
                $progress[$counter] = count($prog);
                $deadline[$counter] = $t->deadline;
                $counter = $counter +1;

            }

            return view('CompanyAdmin.employee_progress', compact('related', 'employee', 'time', 'progress', 'deadline' ,'lesson'));
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
       $c = DB::table('courses')->where('name', $request->hiddenOneValue)->first();
       $tesst = DB::table('course_taken_by')->where('employee_id', $id)->where('course_id', $c->id)->get()->first();
       if($tesst){
           $employee = User::find($id);
           $options = Course::getPossibleCategories();
           session()->flash('Error', 'Employee Already taking this course.');
           return view('CompanyAdmin.give_training', compact('employee', 'options'));       }
       $rr = $request->all();
       DB::table('course_taken_by')->insert(
          array('employee_id' => $id, 'course_id' => $c->id, 'progress' => 0, 'deadline' => $request->deadline_Date, 'created_at' => now())
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
    public function request_special_course($c_id=null, $e_id=null){
        $options = Course::getPossibleCategories();
        $institutions_admins = DB::table('users')->where('role', '2')->get();
        return view('CompanyAdmin.request_special_course', compact('options', 'institutions_admins'));
    }
    public function request_sending(Request $request, $id=null){
        $c = DB::table('courses')->where('name', $request->hiddenOneValue)->first();
        DB::table('course_requested')->insert(
            array('admin_id' => $id, 'instit_id' => $request->instit, 'title' => $request->title, 'description' => $request->desc, 'category'=>$request->category, 'receive_date'=>$request->deadline_Date, 'created_at'=>now())
        );
        session()->flash('Add', 'The Request has been sent to the Institution successfully.');
        $options = Course::getPossibleCategories();
        $institutions_admins = DB::table('users')->where('role', '2')->get();
        return view('CompanyAdmin.request_special_course', compact('options', 'institutions_admins'));
    }

    public function display_requests($id=null){
       $requests = DB::table('course_requested')->where('admin_id', $id)->get();
       $admin = User::find($id);
        $instit = [];
        $counter = 0;

        foreach ($requests as $r){
            $in = User::where('id', '=', $r->instit_id)->get()->first()->name;
            $instit[$counter] = $in;
            $counter = $counter +1;

        }

       return view('CompanyAdmin.display_requests', compact('requests', 'instit', 'admin'));
    }
    public function code($id=null){
       $admin = User::find($id);
       return view('CompanyAdmin.code', compact('admin'));
    }
    public function profile(){
       return view('CompanyAdmin.profile');
    }
    public function changePassword(){
       return view('CompanyAdmin.changePassword');
    }
    public function changePasswordSending(Request $request){
        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);


        #Match The Old Password
        if(!Hash::check($request->old_password, Auth::user()->password)){
            return back()->with("error", "Old Password Doesn't match!");
        }


        #Update the new Password
        User::whereId(Auth::user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("status", "Password changed successfully!");
    }

    public function searchEngine(Request $request){
        $emp = User::where('name','LIKE',"%{$request->search}%");
        $filter_one = $emp->where('code', Auth::user()->code);
        $filter_two = $filter_one->where('role', '0')->get()->first();
        if($filter_two){
            return redirect()->route('employee_progress', ['id' => $filter_two->id]);
        }
        return back()->with("search_error", "Can't find any Employee!");
    }
}
