<?php

namespace App\Http\Controllers\InstitAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\course;
use App\Models\lesson;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class InstitAdminController extends Controller
{
    public function index(){
        return view('InstitAdmin.dashboard');
    }
    public function allCourses()
    {
        $courses = course::simplepaginate(5);
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
                        if( isset($data['file'])){
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
}
