<?php

namespace App\Http\Controllers;

use App\City;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities=City::where('status',1)->paginate(10);
        $provinces=City::selectRaw('distinct(province)')->get(10);
        return view('admin.city-list')->with('city',$cities)->withProvince($provinces);
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

    public function updateStatus($city_id,$value){
        $city=City::find($city_id);
        $city['status']=$value;
        if($city->save()){
            return $this->index();
        }else{
            return back()->withErrors("修改状态失败");
        }
    }

    public function getCityByProvince($province){
        $cities=City::select(['city'])->where('province',$province)->get();
        $cityArr=[];
        foreach ($cities as $city){
            array_push($cityArr,$city->city);
        }
        $message['status']="success";
        $message['city']=$cityArr;
        return $message;
    }

    public function addCity(){
        $province=Input::get('province');
        $city=Input::get('city');

        $item=City::where('province',$province)->where('city',$city)->first();
        if($item==null){
            $message['status']="fail";
            $message['message']="该城市不存在,请仔细检查.";
        }else{
            if($item->status==1){
                $message['status']='fail';
                $message['message']='该城市已经在列表中，请不要重复添加';
                return $message;
            }
            $item['status']=1;
            if($item->save()){
                $message['status']='success';
                $message['message']='添加城市成功';
            }else{
                $message['status']='fail';
                $message['message']='添加城市失败';
            }
        }

        return $message;
    }
}
