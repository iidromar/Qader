<?php

namespace App\Http\Controllers\CompanyAdmin;

use App\Models\Result;
use App\Models\Question;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\ResultRequest;
use App\Models\Option;
use Illuminate\Http\Request;



class ResultController extends Controller
{
   
    public function index(): View
    {
        $results = Result::all();

        return view('CompanyAdmin.results.index', compact('results'));
    }

    public function create(): View
    {
        $questions = Question::all();

        return view('CompanyAdmin.results.create', compact('questions'));
    }

    public function store(Request $request): RedirectResponse
    {
        $result=result::create([
            'total_points'=>$request->total_points,
            'user_id'=>auth()->id(),   
         ]);

        $result->questions()->sync($request->input('questions', []));

        return redirect()->route('course.result')->with([
            'message' => 'successfully created !',
            'alert-type' => 'success'
        ]);
    }

    public function show($id): View
    {
        $result=result::findOrFail($id);
        return view('CompanyAdmin.results.show', compact('result'));
    }

    public function edit($id): View
    {
        $result=result::find($id);

        $questions = Question::all();

        return view('CompanyAdmin.results.edit', compact('result', 'questions'));
    }

    public function update(Request $request, $id): RedirectResponse
    {

        $result=result::find($id);
        if($result){
            $result->update([
                'total_points'=>$request->total_points,
                'user_id'=>auth()->id(),  
             ]);
            }

        $result->questions()->sync($request->input('questions', []));

        return redirect()->route('course.result')->with([
            'message' => 'successfully updated !',
            'alert-type' => 'success'
        ]);
    }

    public function destroy( $id): RedirectResponse
    {
        $result=result::find($id);
        $result->delete();
        return back()->with([
            'message' => 'successfully deleted !',
            'alert-type' => 'danger'
        ]);
    }


}
