@extends('layout.table')
@section('table_list')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 首页</a><a href="#" class="current">报名管理</a></div>
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
                               {{-- <th>审核状态</th>
                                <th>审核操作</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($res as $row)
                                <tr class="gradeX">
                                <td>{{$row->id}}</td>
                                <td>{{$row->name}}</td>
                                <td><img class='shop_img' src="{{$row->photo_url}}" width='100' height='100' /></td>
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
                                {{--<td align="center"><a class="btn btn-info btn-mini">
                                       @if($row->remark==""||$row->remark==null)
                                            审核中
                                       @else
                                            {{$row->remark}}
                                       @endif
                                </a></td>
                                <td align="center">
                                    @if($row->status==0)
                                        <a class="btn btn-success btn-mini" onclick="updateBool('{{url("/signup/status/$row->apply_id/status/1")}}');">
                                            通过
                                        </a>
                                        <a class="btn btn-warning btn-mini" onclick="updateBool('{{url("/signup/status/$row->apply_id/status/-1")}}');">
                                            不通过
                                        </a>
                                    @elseif($row->status==1)
                                        <a class="btn btn-warning btn-mini" onclick="updateBool('{{url("/signup/status/$row->apply_id/status/-1")}}');">
                                            不通过
                                        </a>
                                    @elseif($row->status==-1)
                                        <a class="btn btn-success btn-mini" onclick="updateBool('{{url("/signup/status/$row->apply_id/status/1")}}');">
                                            通过
                                        </a>
                                    @endif
                                </td>--}}
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
    </script>
    @endsection