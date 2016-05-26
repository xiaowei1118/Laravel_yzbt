<?php

namespace App\Http\Controllers;

use App\Notice;
use App\SignUp;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class SignUpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notice_id=Input::get('noticeId');

        $list=SignUp::selectRaw('tb_baby.*,tb_pn_apply.image_url as img_url,tb_pn_apply.is_vote,tb_pn_apply.id as apply_id,tb_wx_user.name as parent_name,tb_wx_user.telephone')
            ->join('tb_baby','tb_pn_apply.baby_id','=','tb_baby.id')
            ->join('tb_wx_user','tb_baby.guardian_openid','=','tb_wx_user.openid');

        if($notice_id==null){
            $list=$list->get();
        }else{
            $list=$list->where('pn_id',$notice_id)->get();
        }
        
        return view('admin.sign-up')->with('res',$list);
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

    public function smallNoticeList(){
        $notices=Notice::select(['id','title','image_url'])->orderBy('create_time','desc')->where('is_apply',1)->get();
        return view('admin.small-notice-list')->with('res',$notices);
    }

    public function updateBool($id,$field,$value){
        $item=SignUp::where('id',$id)->first();
        $item[$field]=$value;
        
        if($item->save()){
            $message['status']="success";
            $message['message']="修改状态成功";

        }else{
            $message['status']="fail";
            $message['message']="修改状态失败";
        }

        return $message;
    }
}
