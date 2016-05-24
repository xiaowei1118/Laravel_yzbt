@extends('layout.app')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="url('/index')" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 首页</a><a href="#" class="current">通告管理</a></div>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
              <div class="widget-title">
                <span class="icon">
                  <i class="icon-align-justify"></i>                  
                </span>
                <h5>添加通告</h5>
              </div>
              <div class="widget-content nopadding">
                <form method="post" class="form-horizontal" action="{{url('/notice')}}">
                  <div class="control-group">
                    <label class="control-label">标题：</label>
                    <div class="controls">
                      <input type="text" name="title"  class="span10" placeholder="请输入标题" required/>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">图片上传 :</label>
                    <div class="controls" id="container">
                      <input type="text" name="image_url" class="span6" value="" readonly required>
                      <div id="filelist"></div>
                      <div id="result"></div>
                      <button type="button" class="btn btn-success btn-mini" id="pickfiles">选择文件</button>
                      <button type="button" class="btn btn-success btn-mini" id="upload">上传</button>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">城市列表：</label>
                    <div class="controls">
                      <select class="span3" name="city_id">
                          @foreach($res2 as $city)
                              <option value="{{$city->city_id}}">{{$city->province."".$city->city}}</option>
                          @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">电话：</label>
                    <div class="controls">
                      <input type="text" name="telephone" class="span10" pattern="1[0-9]{10}"/>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">地址：</label>
                    <div class="controls">
                      <input type="text" name="address" class="span10" required/>
                    </div>
                  </div>
                    <div class="control-group">
                        <label class="control-label">通告类型：</label>
                        <div class="controls">
                            <input type="text" name="type" class="span10" required/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">可报名?：</label>
                        <div class="controls">
                            <select name="is_apply">
                                <option value="0">否</option>
                                <option value="1" selected>是</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group" id="apply_number">
                        <label class="control-label">报名人数：</label>
                        <div class="controls">
                            <input type="number" name="number"/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">可投票?：</label>
                        <div class="controls">
                            <select name="status">
                                <option value="0">否</option>
                                <option value="1" selected>是</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">热门：</label>
                        <div class="controls">
                            <select name="is_hot">
                                <option value="0">否</option>
                                <option value="1" selected>是</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Banner?：</label>
                        <div class="controls">
                            <select name="is_banner">
                                <option value="0">否</option>
                                <option value="1" selected>是</option>
                            </select>
                        </div>
                    </div>
                  <div class="control-group">
                    <label class="control-label">开始时间：</label>
                    <div class="controls">
                      <input type="text" id="start_time" name="registration_time" data-date="2016-01-01" data-date-format="yyyy-mm-dd" value="" class="datepicker"/>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">结束时间：</label>
                    <div class="controls">
                      <input type="text" id="end_date" name="registration_deadline" data-date="2016-01-01" data-date-format="yyyy-mm-dd" value="" class="datepicker"/>
                    </div>
                  </div>
                    <div class="control-group">
                        <label class="control-label">内容：</label>
                        <div class="controls">
                            <script id="editor" name="detail-content" type="text/plain" style="width:1024px;height:500px;">
                            </script>
                        </div>
                    </div>

                  <div class="form-actions">
                    <button name="add" type="submit" class="btn btn-success">添加</button>
                    <input type="reset" class="btn">取消</input>
                  </div>
                </form>
                  @if (count($errors) > 0)
                      <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                  @endif
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