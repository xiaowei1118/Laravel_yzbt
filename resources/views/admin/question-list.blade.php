@extends('layout.table')
@section('table_list')
    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="{{url('index')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> 首页</a><a href="#" class="current">问题管理</a></div>
        </div>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span10">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon">专题：</span>
                            <h5>{{$topic->title}}</h5>
                        </div>
                        <div class="widget-content nopadding updates">
                            @foreach($questions as $i=>$question)
                                <div class="new-update">
                                    <div class="">
                                        <strong>问题{{$i+1}}:{{$question->question}}</strong><a href="#" class="btn btn-info btn-mini" data-bind="click:selectQuestionItem.bind($data,'{{$question->id}}')">编辑问题和答案</a><br/>
                                        @foreach($question['items'] as $key=>$item)
                                           <span style="float:left">{{chr($key+65)}}:{{$item->content}}</span><span style="float:right">已经有{{$item->count or 0}}人投票</span><br/>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="container-fluid">
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="widget-box">
                                <div class="widget-title">
								<span class="icon">
									<i class="icon-align-justify"></i>
								</span>
                                    <h5>问题详情</h5>
                                </div>
                                <div class="widget-content nopadding">
                                    <form method="post" class="form-horizontal" data-bind="with:selectQuestion">
                                        <input type="hidden" data-bind="text:id"/>
                                        <div class="control-group">
                                            <label class="control-label">问题 :</label>
                                            <div class="controls"><input type="text" class="span20" placeholder="编辑问题" data-bind="value:questionTitle"/></div>
                                        </div>
                                        <!--ko foreach:answerList-->
                                        <div class="control-group">
                                            <label class="control-label">答案 <span data-bind="text:$index()+1"></span>:</label>
                                            <div class="controls">
                                                <input type="text" class="span20" placeholder="编辑答案" data-bind="value:$data.content"/>
                                                <input type="hidden" class="span20" data-bind="value:$data.id"/>
                                                <button class="btn btn-warning btn-mini" data-bind="click:$parent.removeItem">删除</button>
                                            </div>
                                        </div>
                                        <!--/ko-->
                                        <div class="form-actions">
                                            <button type="button" class="btn btn-success" onclick="submitData()">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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

        var submitData=function(){
            if(vm.selectQuestion=={}){

            }else{

            }
            $.ajax({
                url:'/question/updateQuestion',
                type:'post',
                data:{data:vm.selectQuestion()},
                success:function(){

                }
            });
        };

        var viewModal=function(){
            var self = this;
            self.selectQuestion=ko.observable({});
            self.questionList=ko.observableArray([]);
            self.createQuestion=ko.observable(false);

            self.selectQuestionItem=function($id){
                for(var key in self.questionList()){
                    if(self.questionList()[key].id()==$id) {
                          var question=new Question();
                          question.id($id);
                          question.questionTitle(self.questionList()[key].questionTitle());
                          var list=self.questionList();
                            _.each(list[key].answerList(),function($item){
                                var $answer={};
                                 _.extend($answer,$item);
                                question.answerList.push($answer);
                            });
                        self.selectQuestion(question);
                    }
                }
            }
        }

        var Question=function(){
            var self=this;
            self.answerList=ko.observableArray([]);
            self.questionTitle=ko.observable();
            self.id=ko.observable(0);
            self.removeItem=function($data){
                self.answerList.remove($data);
            }
        }

        var vm=new viewModal();
        var initQuestionList=function(){
            var $data=$.parseJSON('{!! $questions  !!}');
            $.each($data,function($key,$item){
                var question=new Question();
                question.questionTitle($item.question);
                question.answerList($item.items);
                question.id($item.id);
                vm.questionList.push(question);
            });
        }
        initQuestionList();
        ko.applyBindings(vm);
    </script>
@endsection