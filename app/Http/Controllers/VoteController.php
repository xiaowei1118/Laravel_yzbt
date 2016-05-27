<?php

namespace App\Http\Controllers;

use App\ApplyVote;
use Illuminate\Http\Request;

use App\Http\Requests;

class VoteController extends Controller
{
    function index(){
        $noticeId=Input::get('noticeId');
        $applyId=Input::get('babyId');

        $list=ApplyVote::select()
                ->leftJoin('')
                ->where('pn_id',$noticeId);
        if($applyId){
            $list=$list->where('apply_id',$applyId);
        }
        $list=$list->get();

        return view('admin.vote-list')->with('list',$list);
    }
}
