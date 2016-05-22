<?php
require 'templates/header.php';
$res = $mysql->_doQuery('select * from tb_special_topic order by create_time desc');
?>
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 首页</a><a href="#" class="current">资讯管理</a></div>
    </div>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon"><i class="icon-th"></i></span>
                        <a href="topic-add.php" class="btn btn-primary btn-mini">添加资讯</a>
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
                                <td><?php echo $row['status']=='0'?'<span class="badge badge-info">禁用</span>':''; ?></td>
                                <td><?php echo $row['is_hot']=='1'?'<span class="badge badge-warning">热门</span>':''; ?></td>
                                <td><?php echo $row['is_banner']=='1'?'<span class="badge badge-warning">Banner</span>':''; ?></td>
                                <td>
                                    <a class="btn btn-primary btn-mini" href="<?php echo 'topic-edit.php?id='.$row['id']; ?>">编辑</a>

                                    <?php if($row['status']=='1'){ ?>
                                    <a class="btn btn-warning btn-mini" href="<?php echo 'topic-del.php?b=0&id='.$row['id']; ?>">
                                       禁用
                                    </a>
                                    <?php } else { ?>
                                    <a class="btn btn-warning btn-mini" href="<?php echo 'topic-del.php?b=1&id='.$row['id']; ?>">
                                       启用
                                    </a>
                                    <?php } ?>
                                    
                                    <?php if($row['is_hot']=='1'){ ?>
                                    <a class="btn btn-info btn-mini" href="<?php echo 'topic-hot.php?b=0&id='.$row['id']; ?>">
                                       取消热门
                                    </a>
                                    <?php } else { ?>
                                    <a class="btn btn-info btn-mini" href="<?php echo 'topic-hot.php?b=1&id='.$row['id']; ?>">
                                       设为热门
                                    </a>
                                    <?php } ?>

                                   

                                    <?php if($row['is_banner']=='1'){ ?>
                                    <a class="btn btn-success btn-mini" href="<?php echo 'topic-banner.php?b=0&id='.$row['id']; ?>">
                                       取消Banner
                                    </a>
                                    <?php } else { ?>
                                    <a class="btn btn-success btn-mini" href="<?php echo 'topic-banner.php?b=1&id='.$row['id']; ?>">
                                       设为Banner
                                    </a>
                                    <?php } ?>

                                    <a class="btn btn-success btn-mini" href="<?php echo 'topic-comment-list.php?id='.$row['id']; ?>">
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
<?php
require 'templates/table-footer.php';
?>