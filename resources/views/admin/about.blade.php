@extends('layout.app')
@section('content')
    <div class="row-fluid" style="margin-top:25px;">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title">
                    <span class="icon">
                        <i class="icon-align-justify"></i>
                </span>
                    <h5>关于我们</h5>
                </div>
                <div class="widget-content nopadding">
                    <form action="{{url('/about/update')}}" method="post" class="form-horizontal">
                        <div class="control-group">
                            <label class="control-label">内容 :</label>
                            <div class="controls">
                                <script id="editor" name="content" type="text/plain" style="width:1024px;height:500px;">
                                    {!! $message->content or "" !!}
                                </script>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="/ueditor/lang/zh-cn/zh-cn.js"></script>
<script>
    var ue = UE.getEditor('editor');
    //ue.setContent("hfsdfs");
</script>
@endsection