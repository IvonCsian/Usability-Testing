<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Result;

use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($questionIndex)
    {
        // Retrieve all the rows from the questions table
        $questions = Question::all();

        // Get the question for the current index
        $question = $questions->get($questionIndex-1);

        if($question == null)
        {
            return 'Done';
        }

        else
        {
            // Render the question view with the current question
            //$questionView = view('question', ['question' => $question])->render();

            // Return the question view and the next question index
            return view('question', [
                'question' => $question,
                //'questionView' => $questionView,
                'nextQuestionIndex' => $questionIndex
            ]);
        }
    }

     /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $questionIndex)
    {
        $question = Question::find($questionIndex);
        $time = $request->input('time');
        $user_id = session('user_id');

        $result = Result::create([
            'user_id' => $user_id,
            'question_id' => $question->id,
            'time' => $time,
        ]);

        // Get the next question index
        $nextQuestionIndex = $questionIndex + 1;

        return redirect()->route('questions.show', ['questionIndex' => $nextQuestionIndex]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
