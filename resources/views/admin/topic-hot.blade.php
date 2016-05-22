<?php
require 'templates/header.php';
?><div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 首页</a><a href="#" class="current">资讯管理</a></div>
    </div>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                
            <?php 
                if(isset($_GET['id']) && isset($_GET['b'])){
                    $id = intval($_GET['id']);
                    $b = intval($_GET['b']);
                    $affect = $mysql->_doExec('update tb_special_topic set is_hot='.$b.' where id='.$id);
                    if($affect > 0){
                        if($b==0)
                            echo('<h4>取消热门成功！</h4>点击<a href="topic-list.php"><span class="badge badge-info">这里</span></a>返回');
                        else
                            echo('<h4>设为热门成功！</h4>点击<a href="topic-list.php"><span class="badge badge-info">这里</span></a>返回');
                    }
                }
            ?>
                
            </div>
        </div>
    </div>

    </div>
<?php
require 'templates/footer.php';
?>