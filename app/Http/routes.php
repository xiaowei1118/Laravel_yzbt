<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


//Route::post('login','LoginController@tologin');
//Route::get('login','LoginController@login');
//Route::get('logout','LoginController@logout');

Route::auth();

Route::group(['middleware'=>'auth'], function () {
    Route::get('index',"HomeController@index");
    Route::get('/','HomeController@index');
    Route::get('/home', 'HomeController@index');
    Route::resource('/notice','NoticeController',['only' => ['index', 'edit','store','update','create']]);
    Route::get('/notice/status/{id}/{field}/{value}','NoticeController@updateBool');
    Route::get('/notice/voteDetail','NoticeController@voteDetail');
    Route::post('/notice/voteDetail/update','NoticeController@updateVoteDetail');

    Route::group(['prefix'=>'comment'],function(){
        Route::resource('/','CommentController',['only' => ['index', 'edit','store','update','create']]);
        Route::get('/{id}/delete','CommentController@delete');
        Route::get('/topicComments','CommentController@topicComments');
        Route::get('/topicComments/{id}/delete','CommentController@deleteTopicComments');
    });

    Route::get('/signup/index/{notice_id}','SignUpController@index');
    //Route::resource('signup','SignUpController',['only'=>['']]);
    Route::get('/signup/status/{id}/{field}/{value}','SignUpController@updateBool');

    Route::get('smallNoticeList','SignUpController@smallNoticeList');
    Route::resource('topic','TopicController',['only' => ['index', 'edit','store','update','create']]);
    Route::get('/topic/status/{id}/{field}/{value}','TopicController@updateBool');
    Route::get('/topic/voteDetail','TopicController@voteDetail');

    Route::resource('/city','CityController',['only'=>['index']]);
    Route::get('/city/status/{city_id}/{value}','CityController@updateStatus');
    Route::get('/city/list/{province}','CityController@getCityByProvince');
    Route::post('/city/add','CityController@addCity');

    Route::get('/about','MessageController@about');
    Route::post('/about/update','MessageController@updateAbout');
    Route::get('/baby/mokaimages/{baby_id}','SignUpController@getBabyMokaPicture');
    Route::post('/apply/update/image','SignUpController@updateApplyImage');
    Route::get('/question/topicQuestion/{topicId}','QuestionController@topicQuesion');
    Route::post('/question/updateQuestion','QuestionController@updateQuestion');
    Route::post('/question/createQuestion','QuestionController@createQuestion');
    
    Route::get('/quesion/delete/{id}','QuestionController@delete');
    Route::resource('/message/wechat','MessageController@wehcatMessage');

    Route::get('/export/excel/{noticeId}','SignUpController@exportExcel');

    Route::post('/apply/feedback/update','SignUpController@feedbackUpdate');
});
