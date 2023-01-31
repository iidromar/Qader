<?php

namespace App\Http\Controllers\InstitAdmin;
use App\Models\Option;
use App\Models\course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTestRequest;


class TestController extends Controller
{
    public function index($id)
    {

        $categories = course::with(['courseQuestions' => function ($query) {
            $query->inRandomOrder()
                ->with(['questionOptions' => function ($query) {
                    $query->inRandomOrder();
                }]);
        }])
        ->where('id' , $id)
        ->get();
       
    return view('institAdmin.test.test', compact('categories'));
    }

    public function store(Request $request)
    {
        
        $options = Option::find(array_values($request->input('questions')));

        $result = auth()->user()->userResults()->create([
            'total_points' => $options->sum('points')
        ]);

        $questions = $options->mapWithKeys(function ($option) {
            return [$option->question_id => [
                        'option_id' => $option->id,
                        'points' => $option->points
                    ]
                ];
            })->toArray();

        $result->questions()->sync($questions);

        return redirect()->route('show.Result', $result->id);
    }
}
