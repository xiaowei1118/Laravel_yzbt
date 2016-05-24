<?php

namespace App\Http\Controllers;

use App\Message;
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
}
