<?php

namespace App\Http\Controllers;

use App\AnswerItem;
use App\AnswerVote;
use App\Question;
use App\Topic;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function topicQuesion($topicId){
        $questions=Question::where('st_id',$topicId)->get();
        $topic=Topic::find($topicId);
        foreach ($questions as $question){
            $items=AnswerItem::where('question_id',$question->id)->get();
            foreach($items as $item){
                $item->count=AnswerVote::where('item_id',$item->id)->count();
            }
            $question['items']=$items;
        }

        return view('admin.question-list')->with('questions',$questions)->with('topic',$topic);
    }

    public function updateQuestion(){
        dd(Input::all());
    }
}
