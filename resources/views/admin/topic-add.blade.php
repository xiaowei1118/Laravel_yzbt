@extends('layout.app_boot')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{url('/index')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 首页</a><a href="#" class="current">资讯管理</a></div>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
              <div class="widget-title">
                <span class="icon">
                  <i class="icon-align-justify"></i>                  
                </span>
                <h5>添加资讯</h5>
              </div>
              <div class="widget-content nopadding">
                <form method="post" class="form-horizontal" action="{{url('/topic')}}">
                  <div class="control-group">
                    <label class="control-label">标题：</label>
                    <div class="controls">
                      <input type="text" name="title"  class="span10" placeholder="" required/>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">图片上传 :</label>
                    <div class="controls" id="container">
                      <input type="text" name="image_url" class="span6" value="" required>
                      <div id="filelist"></div>
                      <div id="result"></div>
                      <button type="button" class="btn btn-success btn-mini" id="pickfiles">选择文件</button>
                      <button type="button" class="btn btn-success btn-mini" id="upload">上传</button>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">内容：</label>
                    <div class="controls">
                        <script id="editor" name="content" type="text/plain" style="width:1024px;height:500px;">
                        </script>
                    </div>
                  </div>
                  <div class="form-actions">
                    <button name="add" type="submit" class="btn btn-success">添加</button>
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

<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="/ueditor/lang/zh-cn/zh-cn.js"></script>

<script>
  var ue = UE.getEditor('editor');
</script>
@endsection