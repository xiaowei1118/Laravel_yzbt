@extends('layout.table')
@section('table_list')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="{{url('index')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 首页</a><a href="#" class="current">报名管理</a></div>
    </div>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title">
                       <a href="/export/excel/{{$noticeId}}"><span class="icon"><i class="icon-circle-arrow-down"></i>导出</span></a>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>姓名</th>
                                <th>图片</th>
                                <th>性别</th>
                                <th>生日</th>
                                <th>身高</th>
                                <th>体重</th>
                                <th>居住地</th>
                                <th>监护人</th>
                                <th>监护人手机</th>
                                <th>投票数</th>
                                <th>反馈</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($res as $row)
                                <tr class="gradeX">
                                <td>{{$row->apply_id}}</td>
                                <td>{{$row->name}}</td>
                                <td>
                                    @if($row->img_url)
                                        <img class='shop_img' src="{{$row->img_url}}" width='100' height='100' />
                                    @else
                                        暂无图片
                                    @endif
                                    <a class="btn btn-info btn-mini" style="float:right;margin-right:20px" data-bind="click:getMokaImages.bind($data,'{{$row->id}}','{{$row->apply_id}}')">
                                        @if($row->img_url)
                                            修改图片
                                        @else
                                            添加图片
                                        @endif
                                    </a>
                                </td>
                                <td>
                                    @if($row->sex==-1)
                                        未设置
                                    @elseif($row->sex==0)
                                        女
                                    @elseif($row->sex==1)
                                        男
                                    @endif
                                </td>
                                <td>
                                    @if($row->birthdate!=""&&$row->birthdate!=null&&$row->birthdate!='0000-00-00')
                                        {{date('Y-m-d',strtotime($row->birthdate))}}
                                    @endif
                                </td>
                                <td>{{$row->height or "--"}}</td>
                                <td>{{$row->weight or "--"}}</td>
                                <td>{{$row->living_city or "--"}}</td>
                                <td>{{$row->parent_name or "--"}}</td>
                                <td>{{$row->telephone or "--"}}</td>
                                <td>{{$row->vote_count}}</td>
                                <td>{{$row->feedback or "--"}}</td>
                                <td align="center">
                                    @if($row->is_vote==0)
                                        <a class="btn btn-success btn-mini" onclick="updateBool('{{url("/signup/status/$row->apply_id/is_vote/1")}}');">
                                            通过
                                        </a>
                                    @elseif($row->is_vote==1)
                                        <a class="btn btn-warning btn-mini" onclick="updateBool('{{url("/signup/status/$row->apply_id/is_vote/0")}}');">
                                            不通过
                                        </a>
                                    @endif
                                    @if($row->feedback!="")
                                        <a class="btn btn-warning btn-mini" onclick="addFeedback('{{$row->apply_id}}','{{$row->feedback}}');">
                                            编辑反馈
                                        </a>
                                    @else
                                        <a class="btn btn-warning btn-mini" onclick="addFeedback('{{$row->apply_id}}','{{$row->feedback}}');">
                                            添加反馈
                                        </a>
                                    @endif
                                </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {!! $res->render() !!}
                </div>
            </div>
            <div class="">
                <div class="widget-box">
                    <div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>
								</span>
                        <h5>向报名者发送微信消息</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <form action="{{url('message/wechat')}}" class="form-horizontal" method="post">
                            <input type="hidden" value="{{$noticeId}}" name="noticeId"/>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">消息内容 :</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="message" placeholder="请输入消息内容" required></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-success">发送</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
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
        </div>
    </div>

    <div class="container" id="gallery" style="display:none;width: 600px;height:300px;">
        <div class="row">
            <div class="">
                <div class="">
                    <div class="">
                        <ul class="thumbnails" data-bind="foreach:mokaImages" style="list-style: none">
                            <li class="span2" data-bind="click:$parent.checkImage">
                                <a class="thumbnail lightbox_trigger">
                                    <img alt="" data-bind="attr:{src:$data}" style="height: 90px">
                                </a>
                                <div class="actions">
                                    <a title="选择魔卡照片" href=""><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a>
                                </div>
                            </li>
                        </ul>
                        <!--ko if:mokaImages().length==0-->
                            对不起，用户暂时没有提供摩卡图片
                        <!--/ko-->
                    </div>
                </div>
            </div>
        </div>
</div>

    <div id="feedback_form" style="display: none; width:580px;">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box" style="margin-left:10px">
                    <div class="widget-content nopadding">
                        <form action="#" method="get" class="form-horizontal">
                            <div class="form-group">
                                <label class="control-label col-sm-2">反馈</label>
                                <div class="col-sm-8" data-bind="with:selectSignup">
                                   <input type="hidden" data-bind="value:id"/>
                                   <textarea name="feedback" class="form-control" data-bind="value:feedback"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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

        function addFeedback($apply_id,$feedback){

            vm.selectSignup.id($apply_id);
            vm.selectSignup.feedback($feedback);

            var index=layer.open({
                type: 1,
                zIndex:20,
                shade: true,
                title: "编辑反馈", //不显示标题
                content: $('#feedback_form'), //捕获的元素
                area:['600px','200px'],
                btn:['确定','取消'],
                yes:function(index){
                    $.ajax({
                        url:'/apply/feedback/update',
                        type:'post',
                        dataType:'json',
                        data:{applyId:vm.selectSignup.id(),feedback:vm.selectSignup.feedback()},
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
            })
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

        var SignUp=function(){
            var self=this;
            self.id=ko.observable();
            self.feedback=ko.observable();
        }

        var viewModal=function(){
            var self = this;
            self.mokaImages=ko.observableArray([]);
            self.getMokaImages=function($baby_id,$apply_id,$data){
                self.selectApplyId($apply_id);
                self.selectBabyId($baby_id);
                $.ajax({
                    url:'/baby/mokaimages/'+$baby_id,
                    type:'get',
                    dataType:'json',
                    success:function($data){
                        self.mokaImages($data);
                        addImage();
                    }
                });
            };
            self.selectApplyId=ko.observable();
            self.selectBabyId=ko.observable();
            self.checkImage=function($data,e){
                self.selectImage($data);
                $(e.currentTarget).parent().find('.actions').css({'opacity':0});
                $(e.currentTarget).find('.actions').css({'opacity':1});
            };
            self.selectImage=ko.observable();
            self.selectSignup={
                id:ko.observable(),
                feedback:ko.observable(),
            };
        }


        var vm=new viewModal();
        ko.applyBindings(vm);
    </script>
    @endsection