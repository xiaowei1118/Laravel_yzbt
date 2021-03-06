@extends('layout.app_boot')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{url('index')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 首页</a><a href="#" class="current">通告管理</a></div>
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
                <form method="post" class="form-horizontal" action="{{url('/notice')."/".$res['id']}}">
                  <input type="hidden" value="PUT" name="_method"/>
                  <div class="control-group">
                    <label class="control-label">标题：</label>
                    <div class="controls">
                      <input type="text" name="title" class="span10" placeholder="" value="{{$res['title']}}" required/>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">图片上传 :</label>
                    <div class="controls" id="container">
                      <input type="text" name="image_url" class="span6" value="{{$res['image_url']}}" required="true" readonly>
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
                      <input type="text" name="telephone" class="span10" value="{{$res['telephone']}}" required/>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">地址：</label>
                    <div class="controls">
                      <input type="text" name="address" class="span10" value="{{$res['address']}}" required/>
                    </div>
                  </div>
                    <div class="control-group">
                        <label class="control-label">通告类型：</label>
                        <div class="controls">
                            <input type="text" name="type" class="span10" value="{{$res['type']}}"/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">可报名?：</label>
                        <div class="controls">
                            <select name="is_apply">
                                <option value="0" @if($res['is_apply']==0) selected @endif>否</option>
                                <option value="1" @if($res['is_apply']==1) selected @endif>是</option>
                            </select>
                        </div>
                    </div>
                    @if($res['is_apply']==1)
                        <div class="control-group" id="apply_number">
                            <label class="control-label">报名人数：</label>
                            <div class="controls">
                                <input type="number" name="max_apply_num" value="{{$res['max_apply_num']}}"/>
                            </div>
                        </div>
                    @endif
                    <div class="control-group">
                        <label class="control-label">可投票?：</label>
                        <div class="controls">
                            <select name="status">
                                <option value="0" @if($res['status']==0) selected @endif>否</option>
                                <option value="1" @if($res['status']==1) selected @endif>是</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">热门：</label>
                        <div class="controls">
                            <select name="is_hot">
                                <option value="0" @if($res['is_hot']==0) selected @endif>否</option>
                                <option value="1" @if($res['is_hot']==1) selected @endif>是</option>
                            </select>
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
                  <div class="control-group">
                        <label class="control-label">通告内容：</label>
                        <div class="controls">
                            <script id="editor" name="detail_content" type="text/plain" style="width:1024px;height:500px;">
                                {!! $res['detail_content'] !!}
                            </script>
                        </div>
                    </div>
                  <div class="form-actions">
                    <button type="submit" class="btn btn-success">确定</button>
                    <button type="reset" class="btn">取消</button>
                  </div>
                </form>
              </div>
            </div>
      </div>
    </div>
  </div>
</div>
<script src="/js/jquery.ui.custom.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/bootstrap-colorpicker.js"></script>
<script src="/js/bootstrap-datepicker.js"></script>
<script src="/js/jquery.uniform.js"></script>
<script src="/js/select2.min.js"></script>
<script src="/js/maruti.js"></script>
<script src="/js/maruti.form_common.js"></script>

<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="/ueditor/lang/zh-cn/zh-cn.js"></script>

<script type="text/javascript" src="/js/moxie.js"></script>
<script type="text/javascript" src="/js/plupload.dev.js"></script>
<script type="text/javascript" src="/js/qiniu.js"></script>
<script type="text/javascript" src="/js/upload.js"></script>
<script>
    var ue = UE.getEditor('editor');

    $(function(){
        $('select[name=is_apply]').on('change',function(){
            if($(this).val()=='1'){
                $('#apply_number').show();
                $('input[name=number]').attr('disabled',false);
            }else{
                $('#apply_number').hide();
                $('input[name=number]').attr('disabled',true);
            }
        });
    })
</script>
  @endsection
