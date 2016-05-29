<?php

namespace App\Http\Controllers;

use App\Message;
use App\Services\WechatService;
use App\SignUp;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class MessageController extends Controller
{
    public function about(){
        $message=Message::where('category','aboutus')->first();
        return view('admin.about')->withMessage($message);
    }

    public function updateAbout(Request $request){
        $this->validate($request, [
            'content' => 'required',
        ]);

        $message=Message::firstOrNew(array('category'=>'aboutus'));
        $message->title="关于我们";
        $message->content=Input::get('content');

        if($message->save()){
            return redirect(url('/about'));
        }else{
            return back()->withErrors('保存失败');
        }
    }

    public function wehcatMessage(){
        $noticeId=Input::get('noticeId');
        $accessToken=WechatService::getAccessToken();
        $message=Input::get('message');
        $user=SignUp::select(['openid'])->where('pn_id',$noticeId)->where('is_vote',1)->get();

        if($user==null){
            return back()->withInput()->withErrors("当前已通过的报名人数为0");
        }else{
            foreach ($user as $item){
                $result=WechatService::sendMessage($item->openid,$message,$accessToken);
            }

            if($result[0]==200){
                return back()->withErrors('发送成功');
            }else{
                return back()->withErrors('发送失败');
            }
        }
    }
}
