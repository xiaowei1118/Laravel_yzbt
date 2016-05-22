@extends('layout.table')
@section('table_list')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 首页</a><a href="#" class="current">通告管理</a></div>
    </div>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon"><i class="icon-th"></i></span>
                        <a href="{{url('/notice/create')}}" class="btn btn-primary btn-mini">添加通告</a>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered data-table">
                            <thead>
                            <tr>
                                <th>标题</th>
                                <th>图片</th>
                                <th>城市</th>
                                <th>创建时间</th>
                                <th>地址</th>
                                <th>拍摄期</th>
                                <th>开始时间</th>
                                <th>结束时间</th>
                                <th>电话号码</th>
                                <th>访问量</th>
                                <th>状态</th>
                                <th>热门</th>
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
                                <td><?php echo $row['city'] ?></td>
                                <td><?php echo $row['start_time'] ?></td>
                                <td><?php echo $row['address'] ?></td>
                                <td><?php echo $row['period'] ?></td>
                                <td><?php echo $row['registration_time'] ?></td>
                                <td><?php echo $row['registration_deadline'] ?></td>
                                <td><?php echo $row['telephone'] ?></td>
                                <td><?php echo $row['view_count'] ?></td>
                                <td><?php echo $row['status']=='0'?'<span class="badge badge-info">禁用</span>':''; ?></td>
                                <td><?php echo $row['is_hot']=='1'?'<span class="badge badge-warning">热门</span>':''; ?></td>
                                <td><?php echo $row['is_banner']=='1'?'<span class="badge badge-warning">Banner</span>':''; ?></td>
                                <td>
                                    <a class="btn btn-primary btn-mini" href='{{url("/notice/$row->id/edit")}}'>编辑</a>

                                    <?php if($row['status']=='1'){ ?>
                                    <a class="btn btn-warning btn-mini" href="<?php echo 'notice-del.php?b=0&id='.$row['id']; ?>">
                                       禁用
                                    </a>
                                    <?php } else { ?>
                                    <a class="btn btn-warning btn-mini" href="<?php echo 'notice-del.php?b=1&id='.$row['id']; ?>">
                                       启用
                                    </a>
                                    <?php } ?>

                                    
                                    
                                    <?php if($row['is_hot']=='1'){ ?>
                                    <a class="btn btn-info btn-mini" href="<?php echo 'notice-hot.php?b=0&id='.$row['id']; ?>">
                                       取消热门
                                    </a>
                                    <?php } else { ?>
                                    <a class="btn btn-info btn-mini" href="<?php echo 'notice-hot.php?b=1&id='.$row['id']; ?>">
                                       设为热门
                                    </a>
                                    <?php } ?>

                                   

                                    <?php if($row['is_banner']=='1'){ ?>
                                    <a class="btn btn-success btn-mini" href="<?php echo 'notice-banner.php?b=0&id='.$row['id']; ?>">
                                       取消Banner
                                    </a>
                                    <?php } else { ?>
                                    <a class="btn btn-success btn-mini" href="<?php echo 'notice-banner.php?b=1&id='.$row['id']; ?>">
                                       设为Banner
                                    </a>
                                    <?php } ?>

                                    <a class="btn btn-success btn-mini" href="<?php echo 'notice-comment-list.php?id='.$row['id']; ?>">
                                       查看评论
                                    </a>

                                </td>
                                </tr>
                            <?php }?>
                            </tbody>
                        </table>
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