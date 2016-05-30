<?php

namespace App\Http\Controllers;

use App\Banner;
use App\City;
use App\Notice;
use App\Services\BannerService;
use Carbon\Carbon;
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
        $user=$request->user();
        $notice=New Notice();
        $data=Input::all();
        $notice->fill($data);
        $notice->status=1;
        $notice->publisher_username=$user->name;
        $notice->create_time=Carbon::now()->toDateString();

        if($notice['is_hot']==1){
            $hotCount=Notice::where('is_hot',1)->count();
            if($hotCount>=3){
                return back()->withErrors("热门通告不可以通过三个")->withInput();
            }
        }

        $notice->publisher_username="admin";
        if($notice->save()){
            return $this->index();
        }else{
            return back()->withErrors('保存失败')->withInput();
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

        if($notice['is_hot']==1){
            $hotCount=Notice::where('is_hot',1)->where('id',"!=",$id)->count();
            if($hotCount>=3){
                return back()->withErrors("热门通告不可以超过三个");
            }
        }

        if($notice->save()){
            return $this->index();
        }else{
            return back()->withErrors('保存失败');
        }
    }

    public function updateBool($id,$field,$value){
        $notice=Notice::where('id',$id)->first();
        $notice[$field]=$value;

        if($field=="is_hot"&&$value==1){
            $hotCount=Notice::where('is_hot',1)->count();
            if($hotCount>=3){
                return back()->withErrors("热门通告不可以超过三个");
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
}
