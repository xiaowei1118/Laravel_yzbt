<?php
  require 'templates/header.php';
  require 'sdk/autoload.php';
  use Qiniu\Auth;
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
                <span class="icon">
                  <i class="icon-align-justify"></i>                  
                </span>
                <h5>添加资讯</h5>
              </div>
              <div class="widget-content nopadding">
                <?php
                  $accessKey = 'MlkSiJIWDV-inofBk0LliPwP2Q7ImSYxvp5vYvY0';
                  $secretKey = '-KmOJs6rv8w_1pZH7QS4-e9OZ6cLWbUAK-TPnqaa';
                  $auth = new Auth($accessKey, $secretKey);
                  $bucket = 'kotete';
                  $upToken = $auth->uploadToken($bucket);
                  if(isset($_POST['add'])){
                    null_back($_POST['title'],'请填写标题');
                    null_back($_POST['image_url'],'请上传图片');
                    null_back($_POST['content'],'请填写内容');
                    $title = $_POST['title'];
                    $image_url = $_POST['image_url'];
                    $content = $_POST['content'];
                    $sql = 'insert into tb_special_topic(`publisher_username`,`title`,`image_url`,`content`,`create_time`,`view_count`,`status`,`is_hot`,`is_banner`) values("admin","'.$title.'","'.$image_url.'","'.$content.'","'.date('Y:m:d H:i:s').'",0,1,0,0)';
                    $affect = $mysql->_doExec($sql);
                    if($affect > 0){
                      alert_href('添加成功!','topic-list.php');
                    }else{
                      alert_back('添加失败!');
                    }
                  }
                ?>
                <form method="post" class="form-horizontal">
                  <div class="control-group">
                    <label class="control-label">标题：</label>
                    <div class="controls">
                      <input type="text" name="title"  class="span10" placeholder="" />
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">图片上传 :</label>
                    <div class="controls" id="container">
                      <input type="hidden" id="domain" value="http://o776zhiyp.bkt.clouddn.com/">
                      <input type="hidden" id="token" value="<?php echo $upToken; ?>" />
                      <input type="text" name="image_url" class="span6" value="" readonly>
                      <div id="filelist"></div>
                      <div id="result"></div>
                      <button type="button" class="btn btn-success btn-mini" id="pickfiles">选择文件</button>
                      <button type="button" class="btn btn-success btn-mini" id="upload">上传</button>
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">内容：</label>
                    <div class="controls">
                      <textarea name="content" class="span10" rows="6"></textarea>
                    </div>
                  </div>
                  <div class="form-actions">
                    <button name="add" type="submit" class="btn btn-success">添加</button>
                    <button type="reset" class="btn">取消</button>
                  </div>
                </form>
              </div>
            </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="js/moxie.js"></script>
<script type="text/javascript" src="js/plupload.dev.js"></script>
<script type="text/javascript" src="js/qiniu.js"></script>
<script type="text/javascript" src="js/upload.js"></script>
<?php
  require 'templates/form-footer.php';
?>