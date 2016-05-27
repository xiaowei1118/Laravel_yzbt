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
                            <span class="icon"><i class="icon-th"></i></span>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered data-table">
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
                                            @if($row->birthdate!=""&&$row->birthdate!=null&&!strpos($row->birthdate,'0000'))
                                                {{date('Y-m-d',strtotime($row->birthdate))}}
                                            @endif
                                        </td>
                                        <td>{{$row->height or "--"}}</td>
                                        <td>{{$row->weight or "--"}}</td>
                                        <td>{{$row->living_city or "--"}}</td>
                                        <td>{{$row->parent_name or "--"}}</td>
                                        <td>{{$row->telephone or "--"}}</td>
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
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
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

        <div class="container" id="gallery" style="display:none;width: 600px;height:300px;">
            <div class="row">
                <div class="">
                    <div class="widget-box">
                        <div class="widget-content">
                            <ul class="thumbnails" data-bind="foreach:mokaImages">
                                <li class="span2" data-bind="click:$parent.checkImage">
                                    <a class="thumbnail lightbox_trigger">
                                        <img alt="" data-bind="attr:{src:$data}">
                                    </a>
                                    <div class="actions">
                                        <a title="选择魔卡照片" href=""><i class="icon-ok icon-white"></i></a>
                                    </div>
                                </li>
                                <li class="span2">
                                    <a class="thumbnail lightbox_trigger">
                                        <img src="images/gallery/imgbox5.jpg" alt="" >
                                    </a>
                                    <div class="actions">
                                        <a title="" href="#"><i class="icon-pencil icon-white"></i></a>
                                        <a title="" href="#"><i class="icon-remove icon-white"></i></a>
                                    </div>
                                </li>
                            </ul>
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
            self.checkImage=function($data,$event){
                //$($event).select('a')
                console.log($event);
                self.selectImage($data);
            };
            self.selectImage=ko.observable();
        }

        var vm=new viewModal();
        ko.applyBindings(vm);
    </script>
@endsection