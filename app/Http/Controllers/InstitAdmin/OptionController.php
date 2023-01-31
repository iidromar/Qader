<?php

namespace App\Http\Controllers\InstitAdmin;

use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\OptionRequest;
use App\Models\Question;

class OptionController extends Controller
{
   
    public function index(): View
    {
        $options = Option::all();

        return view('InstitAdmin.options.index', compact('options'));
    }

    public function create(): View
    {
        $questions = Question::all()->pluck('question_text', 'id');

        return view('InstitAdmin.options.create', compact('questions'));
    }

    public function store(Request $request): RedirectResponse
    {
        Option::create([
            'points'=>$request->points,
            'option_text'=>$request->option_text,
            'question_id'=>$request->question_id
         ]);

         return redirect()->route('course.option')->with([
            'message' => 'successfully created !',
            'alert-type' => 'success'
        ]);
    }

 
    public function edit($id): View
    {
        $questions = Question::all();
        $option=option::find($id);

        return view('InstitAdmin.options.edit', compact('option', 'questions'));
    }

    public function update(Request $request, $id): RedirectResponse
    {

        $option=option::find($id);
        if($option){
            $option->update([
                'points'=>$request->posints,
                'option_text'=>$request->option_text,
                'question_id'=>$request->question_id
             ]);
            }
        return redirect()->route('course.option')->with([
            'message' => 'successfully updated !',
            'alert-type' => 'success'
        ]);
    }

    public function destroy($id): RedirectResponse
    {
        
        $option=option::find($id);
        $option->delete();
        return back()->with([
            'message' => 'successfully deleted !',
            'alert-type' => 'danger'
        ]);
    }


}
