<?php

namespace App\Http\Controllers\InstitAdmin;
use App\Models\Question;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\course;
use App\Models\Option;
use App\Models\quiz;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{

    public function index(): View
    {
//        $quizs = quiz::all();
        $courses = Course::where('creator', Auth::user()->id)->get();
        $data = new Collection();
        if ($courses){
            foreach ($courses as $c){
                $quizs = quiz::where('course_id', $c->id)->get();
                if ($quizs){
                    $data = $data->merge($quizs);
                }
            }
        }
        return view('InstitAdmin.questions.index', compact('data'));
    }

    public function create(): View
    {
//        $courses = course::all();
        $courses = DB::table('courses')->where('creator', Auth::user()->id)->get();
        return view('InstitAdmin.questions.create', compact('courses'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'Quiz_name'=>['required' , 'string','max:255'],

        ]);
        $test=quiz::where('course_id',$request->course_id)->get();
        if(sizeof($test)!=0){
            $request->Session()->flash('alert-success' , 'Quiz for this course already exist');
            return redirect('/allQuestion');
        }

        $quiz=quiz::create([
            'course_id'=>$request->course_id,
            'name'=>$request->Quiz_name,
        ]);

        $id=$quiz->id;
        $input = $request->all();
        if(isset($input['question_text'])){
            $condition = $input['question_text'];
            foreach ($condition as $key => $condition) {
                $question = new question;
                $question->quiz_id=$id;
                $question->question_text = $input['question_text'][$key];
                $question->save();

                $option = new option;
                $option->question_id=$question->id;
                $option->option_text=$input['option_1'][$key];
                $option->points=1;
                $option->quiz_id=$id;
                $option->save();

                $option = new option;
                $option->question_id=$question->id;
                $option->option_text=$input['option_2'][$key];
                $option->points=0;
                $option->quiz_id=$id;
                $option->save();

                $option = new option;
                $option->question_id=$question->id;
                $option->option_text=$input['option_3'][$key];
                $option->points=0;
                $option->quiz_id=$id;
                $option->save();

                $option = new option;
                $option->question_id=$question->id;
                $option->option_text=$input['option_4'][$key];
                $option->points=0;
                $option->quiz_id=$id;
                $option->save();

            }
        }
        return redirect()->route('course.question')->with([
            'message' => 'successfully created !',
            'alert-type' => 'success'
        ]);
    }


    public function edit(Request $request)
    {
        $id = $request->eee;
        $quiz=quiz::find($id);
        $courses = DB::table('courses')->where('creator', Auth::user()->id)->get();
        $questions=question::where('quiz_id' , $id)->get();
        $options=option::where('quiz_id' , $id)->get();

        return view('InstitAdmin.questions.edit', compact('questions', 'courses', 'options','quiz'));
    }

    public function update(Request $request, $id)
    {
        $quiz=quiz::find($id);
        if($quiz){
            $quiz->update([
                'course_id'=>$request->course_id,
                'name'=>$request->Quiz_name,
            ]);
        }
        $id=$quiz->id;
        $data=$request->all();

        if( isset($data['question_text'])){
            $condition = $data['question_text'];
            foreach($condition as $key => $condition){
                $question= question::findOrFail($data['id_qustion'][$key]);
                if($question){
                    $question->update([
                        'quiz_id'=>$id,
                        'question_text'=>$data['question_text'][$key],
                    ]);
                }
                $option1=option::find($data['id_option_1'][$key]);
                if($option1){
                    $option1->update([
                        'points'=>1,
                        'option_text'=>$data['option_1'][$key],
                        'quiz_id'=>$id,
                        'question_id'=>$data['id_qustion'][$key],
                    ]);
                }
                $option2=option::find($data['id_option_2'][$key]);
                if($option2){
                    $option2->update([
                        'points'=>0,
                        'option_text'=>$data['option_2'][$key],
                        'quiz_id'=>$id,
                        'question_id'=>$data['id_qustion'][$key],
                    ]);
                }
                $option3=option::find($data['id_option_3'][$key]);
                if($option3){
                    $option3->update([
                        'points'=>0,
                        'option_text'=>$data['option_3'][$key],
                        'quiz_id'=>$id,
                        'question_id'=>$data['id_qustion'][$key],
                    ]);
                }
                $option4=option::find($data['id_option_4'][$key]);
                if($option4){
                    $option4->update([
                        'points'=>0,
                        'option_text'=>$data['option_4'][$key],
                        'quiz_id'=>$id,
                        'question_id'=>$data['id_qustion'][$key],
                    ]);
                }
            }
        }

        if( isset($data['question_txt'])){

            $condition = $data['question_txt'];
            foreach ($condition as $key => $condition) {
                $question = new question;
                $question->quiz_id=$id;
                $question->question_text = $data['question_txt'][$key];
                $question->save();

                $option = new option;
                $option->question_id=$question->id;
                $option->option_text=$data['opt_1'][$key];
                $option->points=1;
                $option->quiz_id=$id;
                $option->save();

                $option = new option;
                $option->question_id=$question->id;
                $option->option_text=$data['opt_2'][$key];
                $option->points=0;
                $option->quiz_id=$id;
                $option->save();

                $option = new option;
                $option->question_id=$question->id;
                $option->option_text=$data['opt_3'][$key];
                $option->points=0;
                $option->quiz_id=$id;
                $option->save();

                $option = new option;
                $option->question_id=$question->id;
                $option->option_text=$data['opt_4'][$key];
                $option->points=0;
                $option->quiz_id=$id;
                $option->save();

            }
        }

        return redirect()->route('course.question')->with([
            'message' => 'successfully updated !',
            'alert-type' => 'success'
        ]);
    }

    public function destroy($id): RedirectResponse
    {
        $quiz=quiz::find($id);
        $quiz->delete();
        return back()->with([
            'message' => 'successfully deleted !',
            'alert-type' => 'danger'
        ]);
    }


}
