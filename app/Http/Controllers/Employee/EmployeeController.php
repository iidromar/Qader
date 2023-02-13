<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\course;
use App\Models\lesson;
use App\Models\User;
use App\Models\quiz;
use App\Models\question;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index(){
        $courses = DB::table('course_taken_by')->where('employee_id', Auth::user()->id)->get();
        $data = new Collection();
        $num_of_courses = 0;
        if ($courses){
            $num_of_courses = $courses->count();
            foreach ($courses as $c){
                $temp = DB::table('courses')->where('id', $c->course_id)->get();
                $data = $data->merge($temp);
            }
        }
        if ($data){
            $data_displayed = $data->take(6);
        }        return view('Employee.dashboard', compact('data_displayed', 'num_of_courses'));
    }

    public function calendarIndex($id=null)
    {
        $events = array();
        $bookings = DB::table('course_taken_by')->where('employee_id', $id)->get();
        foreach($bookings as $booking) {
            $c_name = DB::table('courses')->where('id', $booking->course_id)->get()->first();
            $events[] = [
                'id'   => $booking->id,
                'title' => $c_name->name,
                'start' => $booking->deadline,
                'end' => $booking->deadline,
            ];
        }
        return view('Employee.calendar', ['events' => $events]);
    }

    public function destroy($id)
    {
        $booking = DB::table('course_taken_by')->where('id', $id)->delete();
        if(! $booking) {
            return response()->json([
                'error' => 'Unable to locate the event'
            ], 404);
        }

        return $id;
    }

    public function allCourses($id=null)
    {
        $events = array();
        $courses = DB::table('course_taken_by')->where('employee_id', $id)->get();
        foreach($courses as $course) {
            $c_name = DB::table('courses')->where('id', $course->course_id)->get()->first();
            $creator=User::where('id' , $c_name->creator )->get()->first();
            $events[] = [
                'id'   => $c_name->id,
                'title' => $c_name->name,
                'description' => $c_name->description,
                'category' => $c_name->category,
                'creator'=> $creator->name,
                'date'=>$c_name->course_date,
            ];
        }
        return  view('Employee.allCourses', ['events' => $events]);
    }
    public function courseDetails($id)
    {
        $courses=course::findOrFail($id);
        $creatorName = array();
        foreach($courses as $course) {
            $creator=User::where('id' , $courses->creator )->get()->first();
            $creatorName[] = [
                'creator'=> $creator->name,
            ];
        }

        $lessons=lesson::where('course_id' , $id)->get();
        $quiz=quiz::where('course_id' , $id)->get();
        $results=result::where('user_id' , auth()->user()->id)->where('course_id' , $id)->get();
        return view('Employee.courseDetails' , compact('courses' , 'lessons' , 'results' ,'creatorName') );
    }
    public function employeeResult()
    {
        $results = result::where('user_id' , Auth::user()->id)->get();
        return view('Employee.results.index', compact('results'));
    }
    public function showResult($id)
    {
        $result=result::findOrFail($id);
        return view('Employee.results.show', compact('result'));
    }
    public function searchEngineEE(Request $request){
        $course = Course::where('name','LIKE',"%{$request->search}%");
        if($course == null){
            return back()->with("search_error", "Can't find any Course!");
        }
        $cc = $course->first();
        $temp = DB::table('course_taken_by')->where('employee_id', Auth::user()->id)->where('course_id', $cc->id)->get();
        if(!$temp){
            return back()->with("search_error", "Can't find any Course!");
        }
        $temp_2 = $temp->first();
        if($temp_2){
                return redirect()->route('employee.courseDetails', ['id' => $temp_2->id]);
        }
        return back()->with("search_error", "Can't find any Course!");
    }
    public function Employeeprofile(){
        return view('Employee.profile');
    }
    public function changePassword(){
        return view('Employee.changePassword');
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



}
