@extends('layout.table')
@section('table_list')
    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="{{url('index')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 首页</a><a href="#" class="current">问题管理</a></div>
        </div>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span10">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon">专题：</span>
                            <h5>{{$topic->title}}</h5>
                        </div>
                        <div class="widget-content nopadding updates">
                            @foreach($questions as $i=>$question)
                                <div class="new-update">
                                    <div class="">
                                        <strong>问题{{$i+1}}:{{$question->question}}</strong><br/>
                                        @foreach($question['items'] as $key=>$item)
                                           <span style="float:left">{{chr($key+65)}}:{{$item->content}}</span><span style="float:right">已经有{{$item->count or 0}}人投票</span><br/>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{--<div class="row-fluid">--}}
                    {{--<div class="span10">--}}
                        {{--<div class="widget-box">--}}
                            {{--<div class="widget-title"> <span class="icon"><a class="btn btn-default btn-mini">添加问题</a></span>--}}
                                {{--<h5>问题和答案</h5>--}}
                            {{--</div>--}}
                            {{--<div class="widget-content nopadding updates">--}}

                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
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
    <script type="text/javascript">
        $('.shop_img').css({'cursor':'pointer'}).click(function(){
            var src = $(this).attr('src'),width=$(this).width,height=$(this).height;
            layer.open({
                type: 1,
                title: false,
                closeBtn: 0,
                area: [width,height],
                shadeClose: true,
                content: '<img width="'+width+'" height="'+height+'" src="'+src+'">'
            });
        });

        function updateBool(url){
            $.ajax({
                'url':url,
                'type':'get',
                'dataType':'json',
                success:function (data) {
                    if(data['status']="success"){
                        layer.msg(data['message']);
                        window.location.reload();
                    }else{
                        layer.msg(data['message']);
                    }
                }
            });
        }

        function addImage(){
            layer.open({
                type: 1,
                zIndex:20,
                shade: true,
                title: "编辑魔卡图片", //不显示标题
                content: $('#gallery'), //捕获的元素
                area:['700px','400px'],
                btn:['确定','取消'],
                yes:function(index){
                    $.ajax({
                        url:'/apply/update/image',
                        type:'post',
                        dataType:'json',
                        data:{applyId:vm.selectApplyId(),image:vm.selectImage()},
                        success:function(data){
                            if(data['status']=="success"){
                                layer.msg(data['message']);
                                layer.close(index);
                                window.location.reload();
                            }else{
                                layer.msg(data.message);
                            }
                        },
                        error:function (error) {
                            layer.msg('网络异常');
                        }
                    });
                },
                cancel: function(index){
                    layer.close(index);
                }
            });
        }

        var viewModal=function(){
            var self = this;

        }

        var vm=new viewModal();
        ko.applyBindings(vm);
    </script>
@endsection