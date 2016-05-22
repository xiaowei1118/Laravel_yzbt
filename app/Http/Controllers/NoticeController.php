<?php

namespace App\Http\Controllers;

use App\City;
use App\Notice;
use App\Services\QiniuService;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class NoticeController extends Controller
{
    public function index(){
        $notices=Notice::get();
        return view('admin.notice-list')->with('res',$notices);
    }

    public function create(){
        $qiNiu=new QiniuService();
        $token=$qiNiu->getToken();
        $domain=$qiNiu->getDomain();
        $city=City::where('status',1)->get();
        return view('admin.notice-add')->with('token',$token)->with('domain',$domain)
            ->with('res2',$city);
    }

    public function store(Request $request){
        $this->validate($request, [
            'title' => 'required',
            'image_url' => 'required',
            'address'=>'required',
            'telephone'=>'required',
            'period'=>'required',
            'registration_time'=>'required',
            'registration_deadline'=>'required',
        ]);

        $notice=New Notice();
        $data=Input::all();
        $notice->fill($data);
        if($notice->save()){
            return $this->index();
        }else{
            return back()->withErrors('保存失败');
        }
    }

    public function edit($id){
        $qiNiu=new QiniuService();
        $token=$qiNiu->getToken();
        $domain=$qiNiu->getDomain();

        $notice=Notice::find($id);
        $city=City::where('status',1)->get();
        return view('admin.notice-edit')
            ->with('token',$token)->with('domain',$domain)
            ->with('res',$notice)->with('res2',$city);
    }

    public function update(Request $request){
        $this->validate($request, [
            'title' => 'required',
            'image_url' => 'required',
            'address'=>'required',
            'telephone'=>'required',
            'period'=>'required',
            'registration_time'=>'required',
            'registration_deadline'=>'required',
        ]);

        $notice=Notice::find(Input::get('id'));
        $data=Input::all();
        $notice->fill($data);
        if($notice->save()){
            return $this->index();
        }else{
            return back()->withErrors('保存失败');
        }
    }

    public function destroy(){

    }

//    public function show(){
//        $notice=Notice::find($id);
//        return view('');
//    }
}
