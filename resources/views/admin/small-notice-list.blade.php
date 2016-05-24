@extends('layout.table')
@section('table_list')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="{{url('/index')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 首页</a><a href="#" class="current">通告管理</a></div>
    </div>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon"><i class="icon-th"></i></span>
                        <a href="{{url('/notice/create')}}" class="btn btn-primary btn-default">添加通告</a>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered data-table">
                            <thead>
                            <tr>
                                <th>标题</th>
                                <th>图片</th>
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
                                <td>
                                    <a class="btn btn-primary btn-mini" href='{{url("/signup")."?noticeId=$row->id"}}'>查看报名</a>
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