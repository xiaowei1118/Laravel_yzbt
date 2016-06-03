@extends('layout.app')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{url('/index')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 首页</a><a href="#" class="current">投票详情</a></div>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
              <div class="widget-title">
                <span class="icon">
                  <i class="icon-align-justify"></i>                  
                </span>
                <h5>编辑投票详情</h5>
              </div>
              <div class="widget-content nopadding">
                <form method="post" class="form-horizontal" action="{{url('/notice/voteDetail/update')}}">
                    <input type="hidden" name="id" value="{{$item->id}}"/>
                    <input type="hidden" name="type" value="{{$type}}"/>
                    <div class="control-group">
                        <label class="control-label">内容：</label>
                        <div class="controls">
                            <script id="editor" name="content" type="text/plain" style="width:1024px;height:500px;">
                                {!! $item->vote_detail_content !!}
                            </script>
                        </div>
                    </div>

                  <div class="form-actions">
                    <button type="submit" class="btn btn-success">添加</button>
                    <input type="reset" class="btn"/>
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
</script>

@endsection