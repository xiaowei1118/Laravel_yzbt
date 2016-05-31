<?php

namespace App\Http\Controllers;

use App\AnswerItem;
use App\AnswerVote;
use App\Question;
use App\Topic;
use Exception;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class QuestionController extends Controller
{
    public function delete($id)
    {
        try{
            Question::where('id',$id)->delete();
            AnswerItem::where('question_id',$id)->delete();
            $message['status']="success";
            $message['message']="删除成功";
        }catch (Exception $e){
            $message['status']="fail";
            $message['message']='删除失败';
        }

        return $message;
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
        $question=Input::get('question');
        $answers=json_decode(Input::get('answers'));
        $id=Input::get('id');

        DB::beginTransaction();

        try{
            Question::where('id',$id)->update(['question'=>$question]);

            $answer_list_id=[];
            $all_list_id=AnswerItem::select(['id'])->where('question_id',$id)->get();
            foreach ($answers as $item){
                if($item->id!=0){
                    array_push($answer_list_id,$item->id);
                }
            }

            //删除
            foreach ($all_list_id as $t){
                if(array_search($t->id,$answer_list_id)===false){
                    AnswerItem::where('id',$t->id)->delete();
                }
            }

            //新增
            foreach ($answers as $s){
                if($s->id==0){
                    AnswerItem::create(['content'=>$s->content,'question_id'=>$id]);
                }else{
                    AnswerItem::where('id',$s->id)->update(['content'=>$s->content]);
                }
            }

            $message['status']='success';
            $message['message']='修改成功';
            DB::commit();
        }catch (Exception $e){
            DB::rollback();
            dd($e);
            $message['status']='fail';
            $message['message']='修改失败';
        }

        return $message;
    }

    public function createQuestion(){
        $question=Input::get('question');
        $answers=json_decode(Input::get('answers'));
        $topicId=Input::get('topicId');

        DB::beginTransaction();

        try{
            $questionObj=Question::create(['question'=>$question,'st_id'=>$topicId]);
            foreach ($answers as $item){
                AnswerItem::create(['content'=>$item->content,'question_id'=>$questionObj->id]);
            }
            $message['status']='success';
            $message['message']='添加成功';
            DB::commit();
        }catch (Exception $e){
            DB::rollback();
            $message['status']='fail';
            $message['message']='添加失败';
        }

        return $message;
    }
}
