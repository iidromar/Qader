<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\course;
use App\Models\lesson;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function index(){
        return view('InstitAdmin.index');
    }
    public function courseDetails($id)
    {
        $courses=course::findOrFail($id);
        $lessons=lesson::where('course_id' , $id)->get();
        return view('Employee.courseDetails' , compact('courses') , compact('lessons'));
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
        $booking = Booking::find($id);
        if(! $booking) {
            return response()->json([
                'error' => 'Unable to locate the event'
            ], 404);
        }
        $booking->delete();
        return $id;
    }
    public function employeeResult()
    {
        $results = result::where('user_id' , auth()->id())->get();
        return view('Employee.results.index', compact('results'));
    }
    public function showResult($id)
    {
        $result=result::findOrFail($id);
        return view('Employee.results.show', compact('result'));
    }


}
