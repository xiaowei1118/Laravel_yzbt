<?php
require 'templates/header.php';
?>
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 首页</a><a href="#" class="current">通告评论管理</a></div>
    </div>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon"><i class="icon-comment"></i></span>
                        <h5>
                        <?php 
                        if(isset($_GET['id'])){
                            $id = intval($_GET['id']);
                            $res_1 = $mysql->_doQuery('select * from tb_public_notice_comment where public_notice_id='.$id.' order by create_time desc');
                            $title = '';
                            $title_res = $mysql->_doQuery('select title from tb_public_notice where id='.$id);
                            if(count($title_res)>0)
                                $title = $title_res[0]['title'];
                            if(isset($_GET['comment_id'])){
                                $comment_id = intval($_GET['comment_id']);
                                $sql = 'delete from tb_public_notice_comment where id='.$comment_id;
                                if($mysql->_doExec($sql))
                                    alert_href('删除成功！','notice-comment-list.php?id='.$id);
                            }
                        }
                        echo $title;
                        ?>    
                        </h5>
                    </div>
                    <div class="widget-content nopadding">
                        <ul class="activity-list">
                        <?php foreach ($res_1 as $row) {?>
                            <li>
                            <a href="notice-comment-list.php?id=<?php echo $id; ?>&comment_id=<?php echo $row['id']?>" onclick="return confirm('确定删除吗？')">
                            <i class="icon-trash"></i>
                            <?php echo($row['content'].'   发表于:'.$row['create_time'].'');?>
                            </a>
                            </li>
                        <?php }?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    <script type="text/javascript">
        
    </script>
<?php
require 'templates/table-footer.php';
?>