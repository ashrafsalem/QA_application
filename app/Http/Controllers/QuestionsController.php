<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use App\Http\Requests\AskQuestionRequest;

class QuestionsController extends Controller
{

    public function index()
    {
        // solving lazy loading problem , with eager Loading , solving alleviates n+1 problem
        // here if i not set the relation with query will load all the users related to questions
        // it will load first to rows . question count and questions data , the rest will be the users that will be used
//        \DB::enableQueryLog();
//        $questions = Question::with('user')->latest()->paginate(10);
//        view('question.index', compact('questions'))->render();
//        dd(\DB::getQueryLog());

        $questions = Question::with('user')->latest()->paginate(5);
        return view('question.index', compact('questions'));
    }


    public function create()
    {
        $question = new Question();
        return view('question.create', compact('question'));
    }


    public function store(AskQuestionRequest $request)
    {
        $request->user()->questions()->create($request->only('title', 'body'));

        return redirect()->route('questions.index')->with('success', 'Your Question Has Been Added Successfully'); // here embedded session message
    }


    public function show(Question $question)
    {
        //
    }


    public function edit(Question $question)
    {
        //
    }


    public function update(Request $request, Question $question)
    {
        //
    }


    public function destroy(Question $question)
    {
        //
    }
}
