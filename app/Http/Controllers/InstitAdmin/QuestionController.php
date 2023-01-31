<?php

namespace App\Http\Controllers\InstitAdmin;
use App\Models\Question;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\course;
class QuestionController extends Controller
{
   
    public function index(): View
    {
        $questions = Question::all();

        return view('InstitAdmin.questions.index', compact('questions'));
    }

    public function create(): View
    {
        $courses = course::all();

        return view('InstitAdmin.questions.create', compact('courses'));
    }

    public function store(Request $request): RedirectResponse
    {
       Question::create([
            'course_id'=>$request->course_id,
            'question_text'=>$request->question_text,
         ]);
        return redirect()->route('course.question')->with([
            'message' => 'successfully created !',
            'alert-type' => 'success'
        ]);
    }


    public function edit($id): View
    {
        $question=Question::find($id);
        $courses=course::all();
        return view('InstitAdmin.questions.edit', compact('question', 'courses'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $question=question::find($id);
        if($question){
            $question->update([
                'course_id'=>$request->course_id,
                'question_text'=>$request->question_text,
             ]);
            }
        return redirect()->route('course.question')->with([
            'message' => 'successfully updated !',
            'alert-type' => 'success'
        ]);
    }

    public function destroy($id): RedirectResponse
    {
        $question=question::find($id);
        $question->delete();
        return back()->with([
            'message' => 'successfully deleted !',
            'alert-type' => 'danger'
        ]);
    }

  
}
