@extends('layout.app')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 首页</a><a href="#" class="current">通告管理</a></div>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
              <div class="widget-title">
                <span class="icon">
                  <i class="icon-align-justify"></i>                  
                </span>
                <h5>编辑通告</h5>
              </div>
              <div class="widget-content nopadding">
                <form action="#" method="post" class="form-horizontal">
                  <div class="control-group">
                    <label class="control-label">标题：</label>
                    <div class="controls">
                      <input type="text" name="title" class="span10" placeholder="" value="{{$res['title']}}" />
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">图片上传 :</label>
                    <div class="controls" id="container">
                      <input type="hidden" id="domain" value="{{$domain}}">
                      <input type="hidden" id="token" value="{{$token}}" />
                      <input type="text" name="image_url" class="span6" value="{{$res['image_url']}}" readonly>
                      <div id="filelist"></div>
                      <div id="result"></div>
                      <button type="button" class="btn btn-success btn-mini" id="pickfiles">选择文件</button>
                      <button type="button" class="btn btn-success btn-mini" id="upload">上传</button>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">城市：</label>
                    <div class="controls">
                      <select class="span5" name="city_id">
                        @foreach($res2 as $city)
                            @if($city->city_id==$res['city_id'])
                                <option value="{{$city->city_id}}" selected>{{$city->province."".$city->city}}</option>
                            @else
                                <option value="{{$city->city_id}}">{{$city->province."".$city->city}}</option>
                            @endif
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">电话：</label>
                    <div class="controls">
                      <input type="text" name="telephone" class="span10" value="{{$res['telephone']}}" />
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">地址：</label>
                    <div class="controls">
                      <input type="text" name="address" class="span10" value="{{$res['address']}}" />
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">拍摄周期：</label>
                    <div class="controls">
                      <input type="text" name="period" class="span10" value="{{$res['period']}}" />
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">开始时间：</label>
                    <div class="controls">
                    <input type="text" name="registration_time" data-date="2016-01-01" data-date-format="yyyy-mm-dd" value="{{$res['registration_time']}}" class="datepicker"/>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">结束时间：</label>
                    <div class="controls">
                    <input type="text" name="registration_deadline" data-date="2016-01-01" data-date-format="yyyy-mm-dd" value="{{$res['registration_deadline']}}" class="datepicker"/>
                    </div>
                  </div>
                  <div class="form-actions">
                    <button name="save" type="submit" class="btn btn-success">确定</button>
                    <button type="reset" class="btn">取消</button>
                  </div>
                </form>
              </div>
            </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="/js/moxie.js"></script>
<script type="text/javascript" src="/js/plupload.dev.js"></script>
<script type="text/javascript" src="/js/qiniu.js"></script>
<script type="text/javascript" src="/js/upload.js"></script>
  @endsection
