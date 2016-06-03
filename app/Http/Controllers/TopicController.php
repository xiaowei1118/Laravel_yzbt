<?php

namespace App\Http\Controllers;

use App\Banner;
use App\Services\BannerService;
use App\Topic;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list=Topic::orderBy('create_time','desc')->paginate(10);
        return view('admin.topic-list')->with('res',$list);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.topic-add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'image_url' => 'required',
            'content'=>'required',
        ]);

        $user=$request->user();
        $topic=New Topic();
        $data=Input::all();
        $topic->fill($data);
        $topic->publisher_username=$user->name;
        $topic->create_time=Carbon::now()->toDateString();

        if($topic['is_hot']==1){
            $hotCount=Topic::where('is_hot',1)->count();
            if($hotCount>=3){
                return back()->withErrors("热门资讯不可以超过三个");
            }
        }

        if($topic->save()){
            return $this->index();
        }else{
            return back()->withErrors('保存失败');
        }
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

    public function edit($id){
        $topic=Topic::where('id',$id)->get();
        return view('admin.topic-edit')
            ->with('res',$topic);
    }

    public function update(Request $request,$id){
        $this->validate($request, [
            'title' => 'required',
            'image_url' => 'required',
            'content'=>'required',
        ]);

        $topic=Topic::find($id);
        $data=Input::all();

        $topic->fill($data);
        if($topic['is_hot']==1){
            $hotCount=Topic::where('is_hot',1)->where('id',$id)->count();
            if($hotCount>=3){
                return back()->withErrors("热门资讯不可以超过三个");
            }
        }
        if($topic->save()){
            return $this->index();
        }else{
            return back()->withErrors('保存失败');
        }
    }

    public function updateBool($id,$field,$value){
        $notice=Topic::where('id',$id)->first();
        $notice[$field]=$value;

        if($field=="is_hot"&&$value==1){
            $hotCount=Topic::where('is_hot',1)->count();
            if($hotCount>=3){
                return back()->withErrors("热门通告不可以通过三个");
            }
        }

        if($field=="is_banner"&&$value==1){
            if(!BannerService::checkBannerCount()){
                return back()->withErrors("Banner页不可以超过六个")->withInput();
            }else{
                Banner::create(['type_id'=>$id,'type'=>'pn']);//设置banner
            }
        }else if($field=="is_banner"&&$value==0){
            Banner::where('type_id',$id)->delete();
        }

        if($notice->save()){
            return $this->index();
        }else{
            return back()->withErrors('更改状态失败');
        }
    }

    public function voteDetail(){
        $topicId=Input::get('topicId');
        $item=Topic::where('id',$topicId)->first();
        return view('admin.vote_detail')->with('item',$item)->with('type','topic');
    }

    public function updateVoteDetail(){
        $topicId=Input::get('topicId');
        $vote_detail_content=Input::get('content');

        $result=Notice::where('id',$topicId)->update(['vote_detail_count'=>$vote_detail_content]);
        if($result){
            return $this->index();
        }else{
            return back()->withErrors('编辑失败');
        }
    }
}
