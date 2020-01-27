<?php

namespace App\Http\Controllers;

use App\Http\Requests\AskQuestionRequest;
use App\Question;
use Illuminate\Http\Request;

class QuestionsController extends Controller {

    public function __construct(){
        $this->middleware('auth', ['except' => ['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        //\DB::enableQueryLog();
        \DB::disableQueryLog();


$questions = Question::with([
    'user' => function($query){
          $query->select('id', 'name'); 
    }
])->latest()->paginate(5,['id','title','slug','body','views','answers_count','votes_count','user_id','created_at']);

//dd($questions->toArray());

        //$questions = Question::with('user')->latest()->paginate(5);
        return view('questions.index',compact('questions'));

        //view('questions.index',compact('questions'))->render();
        //dd(\DB::getQueryLog());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        \DB::disableQueryLog();
        $question = new Question();
        return view('questions.create',compact('question'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AskQuestionRequest $request) {
        \DB::disableQueryLog();
        $request->user()->questions()->create($request->only('title','body'));
        return redirect()->route('questions.index')->with('success','Your Question has been Submitted');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question) {
        $question->with('user','answers.user')->increment('views');
        //$question->increment('views');
        return view('questions.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question) {
        // if(\Gate::denies('update-question', $question)){
        //     abort(403, "Access Denied");
        // }
        \DB::disableQueryLog();
        $this->authorize("update", $question);
        return view('questions.create',compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(AskQuestionRequest $request, Question $question) {
        // if(\Gate::denies('update-question', $question)){
        //     abort(403, "Access Denied");
        // }
        \DB::disableQueryLog();
        $this->authorize("update", $question); 
        $question->update($request->only('title','body'));
        return redirect()->route('questions.index')->with('success','Your Question has been Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question) {

        // if(\Gate::denies('delete-question', $question)){
        //     abort(403, "Access Denied");
        // }
        \DB::disableQueryLog();
        $this->authorize("delete", $question);
        $question->delete();
        return redirect()->route('questions.index')->with('success','Your Question has been Deleted ');
    }
}
