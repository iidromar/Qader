<?php

namespace App\Http\Controllers\InstitAdmin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;

use Illuminate\Http\Request;
use App\Models\course;
use App\Models\lesson;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Storage;

class InstitAdminController extends Controller
{
    public function index(){
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
            }}

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

        return view('InstitAdmin.dashboard', compact('earnings', 'maid', 'no_action', 'approved', 'rejected', 'quizzes', 'topFive','prices', 'topCourses', 'countAll'));
    }
    public function allCourses()
    {
        $courses = Course::where('creator', Auth::user()->id)->get();
        return view('InstitAdmin.index' , compact('courses'));
    }
    public function show($id)
    {
        $courses=course::findOrFail($id);
        $lessons=lesson::where('course_id' , $id)->get();
        return view('InstitAdmin.show' , compact('courses') , compact('lessons'));
    }
    public function create()
    {
        $options = Course::getPossibleCategories();

        return view('InstitAdmin.createCourse', compact('options'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $check=$request->all();

        if( isset($check['names'])){
            $request->validate([
                'name'=>['required' , 'string','max:255'],
                'description'=>['required' , 'string' ,'max:3000'],
                'category'=>['required' , 'string','max:255'],
                'names'=>[ 'required' , 'array'],
                'names.*'=>[ 'required' , 'string'],
                'descriptions'=>[ 'required' , 'array'],
                'descriptions.*'=>[ 'required' , 'string'],
                'file'=>[ 'required' , 'array'],
                'file.*'=>[ 'required' , 'mimes:mp4'],
            ]);
        }
        else{
            $request->validate([
                'name'=>['required' , 'string','max:255'],
                'description'=>['required' , 'string' ,'max:3000'],
                'category'=>['required' , 'string','max:255'],


            ]);
        }
        try{
            DB::beginTransaction();
            //add course info
            $course=course::create([

                'name'=>$request->name,
                'description'=>$request->description,
                'category'=>$request->category,
                'creator'=>auth()->id(),
                'course_date'=> $request->course_date,
                'price' => $request->price,
            ]);
            //add lesson info
            $id=$course->id;
            $input = $request->all();
            if( isset($input['names'])) {
                $condition = $input['names'];
                foreach ($condition as $key => $condition) {
                    $lesson = new lesson;
                    $lesson->course_id = $id;
                    $file = $input['file'][$key];
                    $fileName = rand(100, 1000000) . time() . $file->getClientOriginalName();;
                    $filePath = public_path('/storage/instit/courses');
                    $file->move($filePath, $fileName);
                    $lesson->video = $fileName;
                    $lesson->names = $input['names'][$key];
                    $lesson->descriptions = $input['descriptions'][$key];
                    $lesson->save();
                }
            }
            DB::commit();
            $request->Session()->flash('alert-success' , 'Course Created Successfully');
            return redirect('/allCorses');
        }
        catch(\Exception $ex){
            DB::rollBack();
            return back()->withErrors($ex->getMessage());
        }


    }
    public function edit($id)
    {

        $lessons=lesson::where('course_id' , $id)->get();
        $courses=course::find($id);
        $options = Course::getPossibleCategories();
        return view('InstitAdmin.editCourse' )->with('courses' , $courses)->with('lessons' , $lessons)->with('options', $options);

    }


    public function update(Request $request, $id)
    {
        $check=$request->all();
        if( isset($check['names'])){
            $request->validate([
                'name'=>['required' , 'string','max:255'],
                'description'=>['required' , 'string' ,'max:3000'],
                'category'=>['required' , 'string','max:255'],
                'names'=>[ 'required' , 'array'],
                'names.*'=>[ 'required' , 'string'],
                'descriptions'=>[ 'required' , 'array'],
                'descriptions.*'=>[ 'required' , 'string'],

            ]);
        }
        else{
            $request->validate([
                'name'=>['required' , 'string','max:255'],
                'description'=>['required' , 'string' ,'max:3000'],
                'category'=>['required' , 'string','max:255'],


            ]);
        }

        $courses=course::find($id);
        if($courses){
            $courses->update([
                'name'=>$request->name,
                'description'=>$request->description,
                'category'=>$request->category,
                'course_date'=> $request->course_date,
                'price' => $request->price,
            ]);

            $data=$request->all();
            if( isset($data['names'])){
                $condition = $data['names'];
                foreach($condition as $key => $condition){
                    if(!empty($condition)){
                        if( isset($data['file'][$key])){
                            $videoName= $data['file'][$key];
                            $videoPath=public_path('/storage/instit/courses');
                            if(File::exists($videoPath . $videoName)){
                                File::delete($videoPath . $videoName);
                            }
                            $file= $data['file'][$key];
                            $fileName= rand(100 , 1000000) . time() . $file->getClientOriginalName();;
                            $filePath=public_path('/storage/instit/courses');
                            $file->move($filePath,$fileName);
                            lesson::where(['id'=>$data['id'][$key]])
                                ->update([
                                    'names'=>$data['names'][$key],
                                    'descriptions'=>$data['descriptions'][$key],
                                    'video'=>$fileName,
                                ]);
                        }
                        else{
                            lesson::where(['id'=>$data['id'][$key]])
                                ->update([
                                    'names'=>$data['names'][$key],
                                    'descriptions'=>$data['descriptions'][$key],

                                ]);
                        }
                    }
                }
            }
            if( isset($data['title'])){
                $id=$courses->id;
                $condition = $data['title'];
                foreach ($condition as $key => $condition) {
                    $lesson = new lesson;
                    $lesson->course_id=$id;
                    $file=$data['files'][$key];
                    $fileName= $data['title'][$key] . $file->getClientOriginalName();
                    $filePath=public_path('/storage/instit/courses');
                    $file->move($filePath,$fileName);
                    $lesson->video=$fileName;
                    $lesson->names = $data['title'][$key];
                    $lesson->descriptions = $data['des'][$key];
                    $lesson->save();
                }
            }

        }

        $request->Session()->flash('change-success' , 'Course Updated Successfully');

        return redirect()->route('Instit.show', [$courses->id]);
    }

    public function destroy($id)
    {
        $course= Course::findOrFail($id);
        $course->delete();
        Session()->flash('delete-course' , 'Course Updated Successfully');

        return redirect('/allCorses');

    }
    public function destroyLesson($id)
    {

        $lesson=lesson::find($id);
        $courseId  = $lesson->course_id;
        $lesson->delete();
        Session()->flash('delete-success' , 'Course Updated Successfully');
        return redirect()->route('Instit.show', [$courseId]);
    }

    public function courses_requests(){
        $temp = DB::table('course_requested')->where('instit_id', Auth::user()->id)->where('accepted', '0')->get();
        $names = [];
        $counter = 0;
        foreach ($temp as $t){
            $test = DB::table('companies')->where('admin', $t->admin_id)->get()->first();
            $names[$counter] = $test->name;
            $counter++;
        }
        return view('InstitAdmin.course_requested', compact('temp', 'names'));
    }

    public function accepting_course(Request $request){
        $id = $request->accepttt;
        DB::table('course_requested')->where('id', $id)->update([
            'accepted' => '1',
            'accepted_date' => now(),
        ]);
        session()->flash('Add', 'The Request has been accepted successfully. Please Open a new
        Course and finish it before the specified deadline.');
        $id = Auth::user()->id;
        $temp = DB::table('course_requested')->where('instit_id', $id)->where('accepted', '0')->get();
        $names = [];
        $counter = 0;
        foreach ($temp as $t){
            $test = DB::table('companies')->where('admin', $t->admin_id)->get()->first();
            $names[$counter] = $test->name;
            $counter++;
        }
        return view('InstitAdmin.course_requested', compact('temp', 'names'));
    }
    public function rejecting_course(Request $request){
        $id = $request->rejecttt;
        DB::table('course_requested')->where('id', $id)->update([
            'accepted' => '2',
            'accepted_date' => now(),
        ]);
        session()->flash('Error', 'The Request has been rejected successfully.');
        $id = Auth::user()->id;
        $temp = DB::table('course_requested')->where('instit_id', $id)->where('accepted', '0')->get();
        $names = [];
        $counter = 0;
        foreach ($temp as $t){
            $test = DB::table('companies')->where('admin', $t->admin_id)->get()->first();
            $names[$counter] = $test->name;
            $counter++;
        }
        return view('InstitAdmin.course_requested', compact('temp', 'names'));
    }
    public function searchEngine(Request $request){
        $course = Course::where('name','LIKE',"%{$request->search}%");
        $filter_one = $course->where('creator', Auth::user()->id);
        $filter_two = $filter_one->get()->first();
        if($filter_two){
            return redirect()->route('Instit.show', ['id' => $filter_two->id]);
        }
        return back()->with("search_error", "Can't find any Course!");
    }
    public function Institprofile(){
        return view('InstitAdmin.profile');
    }
    public function changePassword(){
        return view('InstitAdmin.changePassword');
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
    public function forgot_password(){
        return back()->with("forgot_success", "Dear Institution Admin, A link has been sent to your email successfully!");
    }
    public function forgot_passwords(){
        return view('InstitAdmin.forgotPassword');
    }
}
