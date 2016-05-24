<!DOCTYPE html>
<html lang="zh-CN">
<head>
<title>admin</title><meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="/css/bootstrap.min.css" />
<link rel="stylesheet" href="/css/bootstrap-responsive.min.css" />

<link rel="stylesheet" href="/css/datepicker.css" />
<link rel="stylesheet" href="/css/uniform.css" />
<link rel="stylesheet" href="/css/select2.css" />
<link rel="stylesheet" href="/css/maruti-style.css" />
<link rel="stylesheet" href="/css/maruti-media.css" class="skin-color" />
<link rel="stylesheet" href="/css/my.css" />
<script src="/js/jquery.min.js"></script>
<script src="/js/layer/layer.js"></script>
<script src="/js/knockout-3.4.0.js"></script>
</head>
<style>
  .btn-default{
    height:25px;
  }
  .select2-container .select2-choice{
    width:380px;
  }
</style>
<body>

<!--Header-part-->
<div id="header">
  <h1><a href="#">与众不童</a></h1>
</div>
<!--close-Header-part--> 

<!--top-Header-messaages-->
<div class="btn-group rightzero"> <a class="top_message tip-left" title="Manage Files"><i class="icon-file"></i></a> <a class="top_message tip-bottom" title="Manage Users"><i class="icon-user"></i></a> <a class="top_message tip-bottom" title="Manage Comments"><i class="icon-comment"></i><span class="label label-important">5</span></a> <a class="top_message tip-bottom" title="Manage Orders"><i class="icon-shopping-cart"></i></a> </div>
<!--close-top-Header-messaages--> 

<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
    {{--<li class="" ><a title="" href="#"><i class="icon icon-user"></i> <span class="text">个人资料</span></a></li>--}}
    {{--<li class=" dropdown" id="menu-messages"><a href="#" data-toggle="dropdown" data-target="#menu-messages" class="dropdown-toggle"><i class="icon icon-envelope"></i> <span class="text">消息</span<b class="caret"></b></a>--}}
    {{--</li>--}}
    {{--<li class=""><a title="" href="#"><i class="icon icon-cog"></i> <span class="text">设置</span></a></li>--}}
    <li class=""><a title="" href="{{url('/logout')}}" onclick="return confirm('确定退出吗？')"><i class="icon icon-share-alt"></i> <span class="text">退出</span></a></li>
  </ul>
</div>
{{--<div id="search">--}}
  {{--<input type="text" placeholder="搜索..."/>--}}
  {{--<button type="submit" class="tip-left" title="Search"><i class="icon-search icon-white"></i></button>--}}
{{--</div>--}}
<!--close-top-Header-menu-->

<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i>首 页</a>
  <ul>
    <li><a href="{{url('/index')}}"><i class="icon icon-home"></i><span>首 页</span></a></li>
    <li><a href="{{url('/notice')}}"><i class="icon icon-signal"></i><span>通 告 管 理</span></a></li>
    <li><a href="{{url('/smallNoticeList')}}"><i class="icon icon-signal"></i><span>报 名 管 理</span></a>
    </li>
    {{--<li><a href="#"><i class="icon icon-inbox"></i><span>商 家 管 理</span></a></li>--}}
    {{--<li><a href="#"><i class="icon icon-th"></i><span>二 维 码 管 理</span></a></li>--}}
    {{--<li><a href="#"><i class="icon icon-fullscreen"></i><span>统 计 分 析</span></a></li>--}}
    {{--<li><a href="#"><i class="icon icon-th-list"></i><span>运 营 管 理</span></a></li>--}}
    <li><a href="#"><i class="icon icon-tint"></i><span>资讯管理</span></a>
        <ul>
            <li><a href="{{url('/topic')}}">资 讯 管 理</a></li>
        </ul>
    </li>
    <li><a href="#"><i class="icon icon-tint"></i><span>投票管理</span></a>
    </li>
    <li><a href="#"><i class="icon icon-pencil"></i><span>系 统 管 理</span></a>
      <ul>
        <li><a href="{{url('/city')}}">开 通 城 市 管 理</a></li>
        {{--<li><a href="#">摄 影 师 管 理</a></li>--}}
        {{--<li><a href="#">平 台 电 话 设 置</a></li>--}}
        <li><a href="{{url('/about')}}">关 于 我 们</a></li>
      </ul>
    </li>
  </ul>
</div>

<?php
//  require_once 'config/db.php';
//  if(! isset($_COOKIE['username'])){
//    alert_href('您尚未登录！','login.php');
//  };
//?>
@yield('content')

<div class="row-fluid">
  <div id="footer" class="span12"> 2016 &copy; YZBT Admin. </div>
</div>
</body>
<script>
//    $(function () {
//        $height=$(window).height();
//        $('#content').css({'height':$height-$('#head').height()-$('#sidebar').height()-95});
//    });
</script>
</html>
