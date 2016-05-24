<?php

namespace App\Http\Controllers;

use App\Services\QiniuService;
use App\Topic;
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
        $list=Topic::orderBy('create_time','desc')->get();
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
            // 'image_url' => 'required',
            'content'=>'required',
        ]);

        $topic=New Topic();
        $data=Input::all();
        $topic->fill($data);
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
        if($topic->save()){
            return $this->index();
        }else{
            return back()->withErrors('保存失败');
        }
    }

    public function updateBool($id,$field,$value){
        $notice=Topic::where('id',$id)->first();
        $notice[$field]=$value;
        if($notice->save()){
            return $this->index();
        }else{
            return back()->withErrors('更改状态失败');
        }
    }
}
