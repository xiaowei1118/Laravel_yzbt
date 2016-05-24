<?php

namespace App\Http\Controllers;

use App\City;
use App\Notice;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class NoticeController extends Controller
{
    public function index(){
        $notices=Notice::orderBy('create_time','desc')->get();
        return view('admin.notice-list')->with('res',$notices);
    }

    public function create(){
        $city=City::where('status',1)->get();
        return view('admin.notice-add')->with('res2',$city);
    }

    public function store(Request $request){
        $this->validate($request, [
            'title' => 'required',
            'image_url' => 'required',
            'address'=>'required',
            'telephone'=>'required',
            'registration_time'=>'required',
            'registration_deadline'=>'required',
        ]);

        $notice=New Notice();
        $data=Input::all();
        $notice->fill($data);
        $notice->publisher_username="admin";
        if($notice->save()){
            return $this->index();
        }else{
            return back()->withErrors('保存失败');
        }
    }

    public function edit($id){
        $notice=Notice::find($id);
        $city=City::where('status',1)->get();
        return view('admin.notice-edit')
            ->with('res',$notice)->with('res2',$city);
    }

    public function update(Request $request,$id){
        $this->validate($request, [
            'title' => 'required',
            'image_url' => 'required',
            'address'=>'required',
            'telephone'=>'required',
            'registration_time'=>'required',
            'registration_deadline'=>'required',
        ]);

        $notice=Notice::find($id);
        $data=Input::all();
        $notice->fill($data);
        if($notice->save()){
            return $this->index();
        }else{
            return back()->withErrors('保存失败');
        }
    }

    public function updateBool($id,$field,$value){
        $notice=Notice::where('id',$id)->first();
        $notice[$field]=$value;
        if($notice->save()){
            return $this->index();
        }else{
            return back()->withErrors('更改状态失败');
        }
    }
}
