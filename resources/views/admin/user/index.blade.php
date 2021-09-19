@extends('layout.main')

@section('content')

    <div class="page-container">
        <div class="text-c"> 日期范围：
            <input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}' })" id="datemin" value="{{ $datemin }}" class="input-text Wdate" style="width:120px;">
            -
            <input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d' })" id="datemax" value="{{ $datemax }}" class="input-text Wdate" style="width:120px;">
            <input type="text" class="input-text" style="width:250px" placeholder="输入会员名称、电话、邮箱" id="kw" name="">
            <button type="button" class="btn btn-success radius" id="searchbtn" name=""><i class="Hui-iconfont">&#xe665;</i> 搜用户</button>
        </div>
        <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a href="javascript:;" onclick="member_add('添加用户','member-add.html','','510')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加用户</a></span> <span class="r">共有数据：<strong>88</strong> 条</span> </div>
        <div class="mt-20">
            <table class="table table-border table-bordered table-hover table-bg table-sort">
                <thead>
                <tr class="text-c">
                    <th width="25"><input type="checkbox" name="" value=""></th>
                    <th width="80">ID</th>
                    <th width="100">用户名</th>
                    <th width="40">性别</th>
                    <th width="90">手机</th>
                    <th width="150">邮箱</th>
                    <th width="">地址</th>
                    <th width="130">加入时间</th>
                    <th width="70">状态</th>
                    <th width="100">操作</th>
                </tr>
                </thead>
                <tbody>

{{--                @foreach($data as $item)    --}}{{--客户端的分页时使用该段代码--}}{{--
                <tr class="text-c">
                    <td><input type="checkbox" value="{{ $item->id }}" name="ids[]"></td>
                    <td>{{ $item->id }}</td>
                    <td><u style="cursor:pointer" class="text-primary" onclick="member_show('{{ $item->username }}','member-show.html','10001','360','400')">{{ $item->username }}</u></td>
                    <td>男</td>
                    <td>13000000000</td>
                    <td>admin@mail.com</td>
                    <td class="text-l">北京市 海淀区</td>
                    <td>{{ $item->created_at }}</td>
                    <td class="td-status"><span class="label label-success radius">已启用</span></td>
                    <td class="td-manage">
                        <a style="text-decoration:none" onClick="member_stop(this,'10001')" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a> <a title="编辑" href="javascript:;" onclick="member_edit('编辑','member-add.html','4','','510')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a style="text-decoration:none" class="ml-5" onClick="change_password('修改密码','change-password.html','10001','600','270')" href="javascript:;" title="修改密码"><i class="Hui-iconfont">&#xe63f;</i></a> <a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>

                @endforeach--}}
                </tbody>
            </table>
        </div>
    </div>

@endsection


@section('js')

    <script>
        $(function(){
            //datatables的初始化
            var datatable = $('.table-sort').dataTable({
                order:[[1,'desc']], //以表格第1列为初始排序，倒序
                stateSave:true,  //保存用户修改过的状态，默认为false
                columnDefs:[
                    {targets:[0,8,9],orderable:false}   //第0,8,9列不使用排序功能
                ],
                lengthMenu:[[3,5,8,-1],[3,"每页5个",8,"All"]], //客户端分页：定义每页显示记录条数的下拉列表值
                //lengthMenu:[10,20,50], //写法2
                //paging:false, //默认分页为true
                //info:false, //默认为显示“显示 1到 1条，共1条”的信息
                searching:false,    //默认为允许搜索条,但会拖慢速度，不推荐
                procssing:true,  //Ajax请求数据时，给客户的提示，即允许显示“正在处理中”,默认为false
                //以上为客户端分页模式，数据量大时不推荐

                serverSide: true,    //开启服务器端模式
                ajax:{
                    url:'{{ route("admin.user.list") }}', //请求地址
                    type:'GET',    //请求方式，get/post
                    //headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}'},  //头部信息，请求csrf，POST时保留; GET时不需要
/*                    data:{  //请求的参数,写法1
                        "user_id":451
                    },*/
/*                    data:function (d){  //请求的参数,写法2.效果一样，但可用于搜索
                        d.user_id = $('#user_id').val();
                    }*/
                    data: (d) => { //写法2的简写,同时，如果只有一个参数，可以不写()
                        d.datemin= $('#datemin').val();
                        d.datemax= $('#datemax').val();
                        d.kw = $.trim($('#kw').val());   //trim删除空格
                    }

                },
                //以下指定各列如何显示
                columns:[
                    //{'data':'字段名',"defaultContent":"默认值",'className':'类名'}, //默认值和类名为可选参数
                    {'data':'aaa',"defaultContent":'',className:'text-c'},
                    {'data':'id'},
                    {'data':'username'},
                    {'data':'aaa',"defaultContent":'男',className:'text-c'},
                    {'data':'aaa',"defaultContent":''},
                    {'data':'aaa',"defaultContent":''},
                    {'data':'aaa',"defaultContent":''},
                    {'data':"created_at"},  //在use.php模型中更改时间显示格式
                    {'data':'deleted_at',"defaultContent":'',className:'text-c'},
                    {'data':'bbb',"defaultContent":'删除和修改',className:'text-c'}, //text-c用于居中显示
                ],
                //回调函数，作用于每行，是当前行的DOM对象，转成jQuery对象$(row)
                //当前数据，当前数据的索引，索引号,本例中只要前两个参数
                createdRow:function(row,data,dataIndex) {
                    //console.log(dataIndex);   //查看每个参数的显示内容
                    //全选的复选框,var可重复声明，let不可以，注意{data.id}使用了ES6：``与‘’的区别
                    var html = `<input type="checkbox" value="${data.id}" name="ids[]" />`;
                    $(row).find('td:eq(0)').html(html);

                    var html = `<span data-id="${data.id}" class="label label-success  radius">有效用户</span>`; //默认有效
                    if(data.deleted_at != null){    //删除时间非空为无效用户
                        html = `<span data-id="${data.id}" class="label label-warning  radius">失效用户</span>`;
                    }
                    $(row).find('td:eq(8)').html(html);

                    //删除和修改
                    var html = `<div class="btn-group">
                                  <a href="/admin/user/edit/${data.id}" class="btn size-S btn-primary radius">修改</a>
                                  <a href="/admin/user/del/${data.id}" class="btn size-S btn-danger-outline radius delbtn">删除</a>
                                </div>`;
                    $(row).find('td:eq(9)').html(html);
                }
            });
            //点击搜索button让datatable加载(ajax请求)，第11行
            $('#searchbtn').click(()=>{
                datatable.api().ajax.reload();
            });
            //给删除delbtn添加事件 委托
            $('.table-sort').on('click','.delbtn',function (evt){
                evt.preventDefault();   //阻止默认事件，或使用return false;
                var url = $(this).attr('href');

                $.ajax({
                    url,
                    type:'DELETE',
                    data:{
                        _token: "{{ csrf_token() }}",
                    },
                    dataType: 'json',
                    success: ret => {
                        $(this).parents('tr').remove();
                        layer.msg('删除成功',{time:4000,icon:6});
                    }
                });

                //alert(url);
            });

        });
    </script>

@endsection
