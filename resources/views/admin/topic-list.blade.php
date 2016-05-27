@extends('layout.table')
@section('table_list')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="{{url('/index')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 首页</a><a href="#" class="current">资讯管理</a></div>
    </div>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon"><i class="icon-th"></i></span>
                        <a href="{{url('/topic/create')}}" class="btn btn-primary btn-default">添加资讯</a>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered data-table">
                            <thead>
                            <tr>
                                <th>标题</th>
                                <th>图片</th>
                                <th>创建时间</th>
                                <th>访问量</th>
                                <th>状态</th>
                                <th>热门</th>
                                <th>投票</th>
                                <th>Banner</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($res as $row) {
                                ?>
                                <tr class="gradeX">
                                <td><?php echo $row['title'] ?></td>
                                <td><?php echo "<img class='shop_img' src='".$row['image_url']."' width='100' height='100' />" ?></td>
                                <td><?php echo $row['create_time'] ?></td>
                                <td><?php echo $row['view_count'] ?></td>
                                <td><?php echo $row['status']==0?'<span class="badge badge-info">禁用</span>':''; ?></td>
                                <td><?php echo $row['is_hot']==1?'<span class="badge badge-warning">热门</span>':''; ?></td>
                                <td>
                                    @if($row->is_vote)
                                        <span class="badge badge-success">可投票</span>
                                    @endif
                                </td>
                                <td><?php echo $row['is_banner']==1?'<span class="badge badge-warning">Banner</span>':''; ?></td>
                                <td>
                                    <a class="btn btn-primary btn-mini" href='{{url("/topic/$row->id/edit")}}'>编辑</a>
                                    <?php if($row['status']=='1'){ ?>
                                    <a class="btn btn-warning btn-mini" href='{{url("/topic/status/$row->id/status/0")}}'>
                                       禁用
                                    </a>
                                    <?php } else { ?>
                                    <a class="btn btn-warning btn-mini" href='{{url("/topic/status/$row->id/status/1")}}'>
                                       启用
                                    </a>
                                    <?php } ?>
                                    
                                    <?php if($row['is_hot']==1){ ?>
                                    <a class="btn btn-info btn-mini" href='{{url("/topic/status/$row->id/is_hot/0")}}'>
                                       取消热门
                                    </a>
                                    <?php } else { ?>
                                    <a class="btn btn-info btn-mini" href='{{url("/topic/status/$row->id/is_hot/1")}}'>
                                       设为热门
                                    </a>
                                    <?php } ?>

                                    <?php if($row['is_banner']==1){ ?>
                                    <a class="btn btn-success btn-mini" href='{{url("/topic/status/$row->id/is_banner/0")}}'>
                                       取消Banner
                                    </a>
                                    <?php } else { ?>
                                    <a class="btn btn-success btn-mini" href='{{url("/topic/status/$row->id/is_banner/1")}}'>
                                       设为Banner
                                    </a>
                                    <?php } ?>

                                    @if($row->is_vote)
                                        <a class="btn btn-warning btn-mini" href='{{url("/topic/status/$row->id/is_vote/0")}}'>
                                            禁止投票
                                        </a>
                                    @else
                                        <a class="btn btn-warning btn-mini" href='{{url("/topic/status/$row->id/is_vote/1")}}'>
                                            启用投票
                                        </a>
                                    @endif
                                    <a class="btn btn-success btn-mini" href='{{url("/comment/topicComments")."?parentId=0&topicId=$row->id"}}'>
                                       查看评论
                                    </a>
                                    @if($row->is_vote)
                                        <a class="btn btn-danger btn-mini" href='{{url("/question/topicQuestion/$row->id")}}'>
                                            查看问题
                                        </a>
                                    @endif
                                </td>
                                </tr>
                            <?php }?>
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
    </script>
    @endsection