<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\checkProgress;
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
            $lessons=lesson::where('course_id' ,$c_name->id)->get();
            $prog=checkProgress::where('course_id' ,$c_name->id)->where('employee_id' , auth()->user()->id)->get();
            $events[] = [
                'id'   => $c_name->id,
                'title' => $c_name->name,
                'description' => $c_name->description,
                'category' => $c_name->category,
                'creator'=> $creator->name,
                'date'=>$c_name->course_date,
                'lessonNum'=>count($lessons),
                'progNum'=>count($prog),
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

        $prog = array();
        $progresses=checkProgress::where('employee_id', auth()->user()->id)->where('course_id',$id)->get();
        foreach($progresses as $progress) {

            $prog[] = [
                'id'   => $progress->id,
                'empId' => $progress->employee_id,
                'lessonId' => $progress->lesson_id,
                'courseId' => $progress->course_id,
                'state' => $progress->state
            ];
        }
        return view('Employee.courseDetails' , compact('courses' , 'quiz', 'lessons' , 'results' ,'creatorName' , 'prog') );
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
    public function progressStore(Request $request)
    {
        $test=checkProgress::where('employee_id',$request->empId)->where('lesson_id', $request->lessonId)->where('course_id',$request->courseId)->get();
        if(sizeof($test)==0){
            $check = checkProgress::create([
                'lesson_id' => $request->lessonId,
                'employee_id' => $request->empId,
                'state' => $request->state,
                'course_id'=>$request->courseId,
            ]);

            $num_of_finished = checkProgress::where('employee_id',$request->empId)->where('course_id',$request->courseId)->get()->count();
            $total = lesson::where('course_id', $request->courseId)->get()->count();
            $percentage = 0;
            if ($total != 0){
                $percentage = ($num_of_finished/$total)*100;
            }else{
                $percentage =0;
            }
            DB::table('course_taken_by')->where('employee_id',$request->empId)->where('course_id',$request->courseId)->update(array('progress'=>$percentage));

            return response()->json([
                'id' => $check->id,
                'state' => $check->state,
                'empId' => $check->employee_id,
                'lessonId' => $check->lesson_id,
                'courseId'=>$check->courseId
            ]);
        }

    }



}
