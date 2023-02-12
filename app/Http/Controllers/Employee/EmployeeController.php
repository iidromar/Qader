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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function index(){
        return view('InstitAdmin.index');
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



}
