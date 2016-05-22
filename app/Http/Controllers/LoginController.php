<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class LoginController extends Controller
{
    public function index(){
        return view('admin.index');
    }

    public function login(){
        return view('admin.login');
    }

    public function tologin(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        $username=Input::get('username');
        $password=Input::get('password');

        $user=Admin::where('username',$username)->first();

        if ($user==null||md5($password)!=$user->password) {
            return back()->withErrors('用户名或者密码错误');
        } else {
           session('username',$username);
           return redirect('/index');
        }
    }

    public function logout(){
        session('username',null);
        return redirect('login');
    }

}
