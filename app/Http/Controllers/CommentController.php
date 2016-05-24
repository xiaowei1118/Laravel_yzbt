<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Notice;
use App\TopicComment;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $noticeId=Input::get('noticeId');
        $parentId=Input::get('parentId');

        $list=Comment::orderBy('create_time','desc');
        if($noticeId!=null){
            $list=$list->where('pn_id',$noticeId);
        }
        if($parentId!=null){
            $list=$list->where('parent_id',$parentId);
        }

        $list=$list->get();
        return view('admin.notice-comment-list')->with('res',$list);
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

    public function delete($id){
        $comment=Comment::find($id);

        if($comment->delete()) {
            $message['status'] = 'success';
            $message['message'] = "删除成功";
        }else{
            $message['status']='fail';
            $message['message']="删除失败";
        }

        return $message;
    }

    public function topicComments()
    {
        $topicId=Input::get('topicId');
        $parentId=Input::get('parentId');

        $list=TopicComment::orderBy('create_time','desc');
        if($topicId!=null){
            $list=$list->where('special_topic_id',$topicId);
        }
        if($parentId!=null){
            $list=$list->where('parent_id',$parentId);
        }

        $list=$list->get();
        return view('admin.topic-comment-list')->with('res',$list);
    }

    public function deleteTopicComments($id){
        $comment=TopicComment::find($id);

        if($comment->delete()) {
            $message['status'] = 'success';
            $message['message'] = "删除成功";
        }else{
            $message['status']='fail';
            $message['message']="删除失败";
        }

        return $message;
    }
}
