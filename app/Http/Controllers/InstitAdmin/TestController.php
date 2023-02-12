<?php

namespace App\Http\Controllers\InstitAdmin;
use App\Models\Option;
use App\Models\course;
use App\Models\quiz;
use App\Models\question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTestRequest;


class TestController extends Controller
{
    public function index($id)
    {
        $course=course::find($id);
        $quiz=quiz::where('course_id',$course->id)->get()->first();
        $questions=question::where('quiz_id',$quiz->id)->with(['questionOptions' => function ($query) {
            $query->inRandomOrder();

        }])
            ->whereHas('questionOptions')->inRandomOrder()
            ->get();
        return view('institAdmin.test.test', compact('course' , 'quiz' , 'questions'));
    }

    public function store(Request $request)
    {

        $options = Option::find(array_values($request->input('questions')));

        $result = auth()->user()->userResults()->create([
            'total_points' => $options->sum('points'),
            'course_id'=>$request->course_id,
        ]);

        $questions = $options->mapWithKeys(function ($option) {
            return [$option->question_id => [
                'option_id' => $option->id,
                'points' => $option->points
            ]
            ];
        })->toArray();

        $result->questions()->sync($questions);

        return redirect()->route('showEmployee.Result', $result->id);
    }
}
