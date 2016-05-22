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
                <h5>编辑资讯</h5>
              </div>
              <div class="widget-content nopadding">
                <?php 
                  $accessKey = 'MlkSiJIWDV-inofBk0LliPwP2Q7ImSYxvp5vYvY0';
                  $secretKey = '-KmOJs6rv8w_1pZH7QS4-e9OZ6cLWbUAK-TPnqaa';
                  $auth = new Auth($accessKey, $secretKey);
                  $bucket = 'kotete';
                  $upToken = $auth->uploadToken($bucket);
                  if(isset($_POST['save']) && isset($_GET['id'])){
                    null_back($_POST['title'],'请填写标题');
                    null_back($_POST['image_url'],'请上传图片');
                    null_back($_POST['content'],'请填写内容');
                    $title = $_POST['title'];
                    $image_url = $_POST['image_url'];
                    $content = $_POST['content'];
                    $sql = "update tb_special_topic set `publisher_username`='admin',`title`='".$title."',`image_url`='".$image_url."',`content`='".$content."' where id=".intval($_GET['id']);
                    $affect = $mysql->_doExec($sql);
                    if($affect > 0){
                      alert_href('修改成功!','topic-list.php');
                    }else{
                      alert_back('修改失败!');
                    }
                  }
                  if(isset($_GET['id'])){
                    $id = intval($_GET['id']);
                    $res = $mysql->_doQuery('select * from tb_special_topic where id='.$id);
                    if(count($res) > 0){
                ?>
                <form action="#" method="post" class="form-horizontal">
                  <div class="control-group">
                    <label class="control-label">标题：</label>
                    <div class="controls">
                      <input type="text" name="title" class="span10" placeholder="" value="<?php echo($res[0]['title']);?>" />
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">图片上传 :</label>
                    <div class="controls" id="container">
                      <input type="hidden" id="domain" value="http://o776zhiyp.bkt.clouddn.com/">
                      <input type="hidden" id="token" value="<?php echo $upToken; ?>" />
                      <input type="text" name="image_url" class="span6" value="<?php echo($res[0]['image_url']);?>" readonly>
                      <div id="filelist"></div>
                      <div id="result"></div>
                      <button type="button" class="btn btn-success btn-mini" id="pickfiles">选择文件</button>
                      <button type="button" class="btn btn-success btn-mini" id="upload">上传</button>
                    </div>
                  </div>
                  
                  <div class="control-group">
                    <label class="control-label">内容：</label>
                    <div class="controls">
                      <textarea name="content" class="span10" rows="6"><?php echo($res[0]['content']);?></textarea>
                    </div>
                  </div>
                  <div class="form-actions">
                    <button name="save" type="submit" class="btn btn-success">确定</button>
                    <button type="reset" class="btn">取消</button>
                  </div>
                </form>
                <?php } } ?>
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