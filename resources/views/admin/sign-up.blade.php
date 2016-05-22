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
                                <th>标题</th>
                                <th>图片</th>
                                <th>状态</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($res as $row) {
                                ?>
                                <tr class="gradeX">
                                <td><?php echo $row['public_notice_id'] ?></td>
                                <td><?php echo $row['title'] ?></td>
                                <td><?php echo "<img class='shop_img' src='".$row['image_url']."' width='100' height='100' />" ?></td>
                                <td><?php echo $row['status']=='0'?'<span class="badge badge-info">禁用</span>':''; ?></td>
                                <td>
                                <a class="btn btn-primary btn-mini" href="<?php echo 'sign-up-baby.php?id='.$row['public_notice_id']; ?>">查看</a>

                                <?php if($row['status']=='1'){ ?>
                                <a class="btn btn-warning btn-mini" href="<?php echo 'sign-up.php?id='.$row['public_notice_id']; ?>">
                                   禁用
                                </a>
                                <?php } else { ?>
                                <a class="btn btn-warning btn-mini" href="<?php echo 'sign-up.php?id='.$row['public_notice_id']; ?>">
                                   启用
                                </a>
                                <?php } ?>
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