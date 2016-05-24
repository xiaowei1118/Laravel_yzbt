@extends('layout.app')
@section('content')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 首页</a><a href="#" class="current">资讯管理</a></div>
    </div>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon"><i class="icon-comment"></i></span>
                        <h5>
                        </h5>
                    </div>
                    <div class="widget-content nopadding">
                        <ul class="activity-list">
                        <?php foreach ($res as $row) {?>
                            <li>
                            <a>
                                <i class="icon-trash" onclick="deleteComment('{{url("/comment/topicComments/$row->id/delete")}}');"></i>
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
        function deleteComment(url){
           var index= layer.confirm('确定要删除吗？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                $.ajax({
                    'url':url,
                    'type':'get',
                    'dataType':'json',
                    success:function (data) {
                        if(data['status']="success"){
                            layer.msg('删除成功');
                            window.location.reload();
                        }else{
                            layer.msg('删除失败');
                        }
                    }
                });
            }, function(){
                layer.close(index);
            });
        }
    </script>
@endsection