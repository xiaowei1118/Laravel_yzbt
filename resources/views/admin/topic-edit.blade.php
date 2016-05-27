@extends('layout.app')
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
                <h5>编辑资讯</h5>
              </div>
              <div class="widget-content nopadding">
                <form action='{{url("/topic")."/".$res[0]['id']}}' method="post" class="form-horizontal">
                    <input type="hidden" value="PUT" name="_method"/>
                  <div class="control-group">
                    <label class="control-label">标题：</label>
                    <div class="controls">
                      <input type="text" name="title" class="span10" placeholder="" value="<?php echo($res[0]['title']);?>" required/>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">图片上传 :</label>
                    <div class="controls" id="container">
                      <input type="text" name="image_url" class="span6" value="<?php echo($res[0]['image_url']);?>" required>
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
                        {!! $res[0]['content'] !!}
                      </script>
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

<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="/ueditor/lang/zh-cn/zh-cn.js"></script>

<script>
  var ue = UE.getEditor('editor');
</script>
  @endsection