@extends('layout.table')
@section('table_list')
<style>
    .select2-container .select2-choice{
        width:140px;
    }
</style>
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="url('index')" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 首页</a><a href="#" class="current">通告管理</a></div>
    </div>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon"><i class="icon-th"></i></span>
                        <a onclick="addCity();" class="btn btn-primary btn-default">添加城市</a>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered data-table">
                            <thead>
                            <tr>
                                <th>城市id</th>
                                <th>省</th>
                                <th>市</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($city as $item)
                                    <tr>
                                        <td>{{$item->city_id}}</td>
                                        <td>{{$item->province}}</td>
                                        <td>{{$item->city}}</td>
                                        <td>
                                            @if($item->status==0)
                                                <a class="btn btn-info btn-mini" href='{{url("/city/status/$item->city_id/1")}}'>
                                                    启用
                                                </a>
                                            @else
                                                <a class="btn btn-warning btn-mini" href='{{url("/city/status/$item->city_id/0")}}'>
                                                    禁用
                                                </a>
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach
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
    <div id="city_form" style="display: none; width:460px;">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box" style="margin-left:10px">
                    <div class="widget-content nopadding">
                        <form action="#" method="get" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">省</label>
                                <div class="controls">
                                    <select name="province" style="width:150px;" onchange="whenChange();">
                                        @foreach($province as $item)
                                            <option>{{$item->province}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">市</label>
                                <div class="controls">
                                    <select name="city" style="width:150px" data-bind="options:cityList">
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var ViewModel=function(){
        var self=this;
        self.cityList=ko.observableArray([]);
    }

    var vm=new ViewModel();

    ko.applyBindings(vm);

    function addCity() {
        layer.open({
            type: 1,
            zIndex:20,
            shade: false,
            title: "添加城市", //不显示标题
            content: $('#city_form'), //捕获的元素
            area:['500px','250px'],
            btn:['确定','取消'],
            yes:function(index){
                $.ajax({
                    url:'/city/add',
                    type:'post',
                    dataType:'json',
                    data:{city:$('select[name=city]').val(),province:$('select[name=province]').val()},
                    success:function(data){
                        if(data['status']=="success"){
                            layer.msg("添加城市成功");
                            layer.close(index);
                            window.location.reload();
                        }else{
                            layer.msg(data.message);
                        }
                    },
                    error:function (error) {
                        layer.msg('网络异常');
                    }
                });
            },
            cancel: function(index){
                layer.close(index);
            }
        });
    }

    whenChange();
    function whenChange() {
        var province=$('select[name=province]').val();
        $('.select2-choice span').eq(2).text("");
        vm.cityList([]);
        $.ajax({
            url:'/city/list/'+province,
            type:'get',
            dataType:'json',
            success:function(data){
                if(data['status']=="success"){
                    vm.cityList(data['city']);
                    $('.select2-choice span').eq(2).text($('select[name=city]').val());
                }else{
                    layer.msg('获取省份失败');
                }
            },
            error:function (error) {
                layer.msg('网络异常');
            }
        });
    }

</script>
@endsection