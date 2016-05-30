<?php

namespace App\Http\Controllers;

use App\ApplyVote;
use App\Baby;
use App\Notice;
use App\SignUp;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;

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

        $list=SignUp::selectRaw('tb_baby.*,tb_pn_apply.image_url as img_url,tb_pn_apply.is_vote,tb_pn_apply.feedback,tb_pn_apply.id as apply_id,tb_wx_user.name as parent_name,tb_wx_user.telephone')
            ->join('tb_baby','tb_pn_apply.baby_id','=','tb_baby.id')
            ->join('tb_wx_user','tb_baby.guardian_openid','=','tb_wx_user.openid');

        if($notice_id==null){
            $list=$list->get();
        }else{
            $list=$list->where('pn_id',$notice_id)->get();
        }

        foreach ($list as $item){
            if($item->is_apply){
                $item->vote_count=ApplyVote::where("apply_id",$item->apply_id)->count();
            }
        }
        return view('admin.sign-up')->with('res',$list)->with('noticeId',$notice_id);
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

    public function getBabyMokaPicture($baby_id){
        $baby=Baby::select(['moka_image_urls'])->where('id',$baby_id)->first();

        $imageUrl=$baby->moka_image_urls;
        return json_decode($imageUrl);
    }

    public function updateApplyImage(){
        $applyId=Input::get('applyId');
        $image=Input::get('image');

        $sign=SignUp::where('id',$applyId)->first();
        $sign->image_url=$image;
        if($sign->save()){
            $message['status']='success';
            $message['message']='更换图片成功';
        }else{
            $message['status']="fail";
            $message['message']="更换图片失败";
        }

        return $message;
    }

    public function exportExcel(Request $request,$noticeId){
        $user=$request->user();
        $data=$list=SignUp::selectRaw('tb_baby.*,tb_pn_apply.image_url as img_url,tb_pn_apply.is_vote,tb_pn_apply.id as apply_id,tb_wx_user.name as parent_name,tb_wx_user.telephone')
            ->join('tb_baby','tb_pn_apply.baby_id','=','tb_baby.id')
            ->join('tb_wx_user','tb_baby.guardian_openid','=','tb_wx_user.openid');

        if($noticeId==null){
            $list=$list->get();
        }else{
            $list=$list->where('pn_id',$noticeId)->get();
        }

        foreach ($list as $item){
            if($item->is_apply){
                $item->vote_count=ApplyVote::where("apply_id",$item->apply_id)->count();
            }
        }

        Excel::create('通告表', function($excel) use($user,$list){

            // Set the title
            $excel->setTitle('通告报名表');

            // Chain the setters
            $excel->setCreator($user->name)
                ->setCompany('yzbt');

            $excel->setDescription('通告报名名单');

            $excel->sheet('名单',function($sheet) use($list){
                $sheet->setOrientation('landscape');

                $sheet->fromModel($list,null,'A1',true,true);
//                $sheet->prependRow(1, array(
//                    'id', 'openid','头像','昵称','姓名','性别(0-女，1-男，-1不确定)','生日','身高','体重','居住城市','特长','摩卡图片',
//                ));
            });
        })->download('xls');

        return true;
    }

    public function feedbackUpdate(){
        $applyId=Input::get('applyId');
        $feedback=Input::get('feedback');

        $result=SignUp::where('id',$applyId)->update(array('feedback'=>$feedback));
        if($result){
            $message['status']='success';
            $message['message']="修改反馈成功";
        }else{
            $message['status']='fail';
            $message['message']="修改反馈失败";
        }
        return $message;
    }
}
