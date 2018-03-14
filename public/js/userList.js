layui.use(['form','layer','table','laytpl'],function(){
    var form = layui.form,
        layer = parent.layer === undefined ? layui.layer : top.layer,
        $ = layui.jquery,
        laytpl = layui.laytpl,
        table = layui.table;
    var _token=$('meta[name="csrf-token"]').attr('content');

    //用户列表======完成=======
    var tableIns = table.render({
        elem: '#userList',
        url : '/admin/api/users',
        cellMinWidth : 95,
        page : true,
        height : "full-125",
        limits : [5,10,15,20,25],
        limit : 5,
        id : "userListTable",
        cols : [[
            {type: "checkbox", fixed:"left", width:50},
            {field: 'id', title: 'ID', width:60, align:"center"},
            {field: 'name', title: '用户名', minWidth:100, align:"center"},
            {field: 'email', title: '用户邮箱', minWidth:200, align:'center',templet:function(d){
                return '<a class="layui-blue" href="mailto:'+d.email+'">'+d.email+'</a>';
            }},
            {field: 'sex', title: '性别', width:80,align:'center',templet:function(d){
                return d.sex == "1" ? "男" : "女";
            }},
            {field: 'status', title: '用户状态', width:100, align:'center',templet:function(d){
                return d.status == "1" ? "正常使用" : "限制使用";
            }},
            {field: 'is_admin', title: '用户类型',width:100, align:'center',templet:function(d){
                if(d.is_admin == "0"){
                    return "注册会员";
                }else if(d.is_admin == "1"){
                    return "管理员";
                }
            }},
            {field: 'created_at', title: '注册时间', align:'center',minWidth:150},
            {field: 'user_agent', title: '客户端', align:'center',minWidth:150},
            {field: 'ip', title: 'IP', align:'center',minWidth:150},
            {field: 'address', title: '城市', align:'center',minWidth:150},
            {field: 'last_login_in', title: '最后登录时间', align:'center',minWidth:150},
            {title: '操作', minWidth:175, templet:'#userListBar',align:"center",fixed:"right"}
        ]]
    });

    //搜索【此功能需要后台配合，所以暂时没有动态效果演示】
    $(".search_btn").on("click",function(){
        if($(".searchVal").val() != ''){
            table.reload("newsListTable",{
                page: {
                    curr: 1 //重新从第 1 页开始
                },
                where: {
                    key: $(".searchVal").val()  //搜索的关键字
                }
            })
        }else{
            layer.msg("请输入搜索的内容");
        }
    });

    //添加用户
    function addUser(edit){
        if(edit){
            content= "/admin/users/"+ edit.id+"/edit";
        }else{
            content= "/admin/users/create";
        }
        layer.open({
            title : "编辑用户",
            type : 2,
            offset: 'auto',
            maxmin: true,//开启最大化最小化按钮
            area: ['1000px', '600px'],
            content : content,
            success : function(layero, index){
                setTimeout(function(){
                    layui.layer.tips('点击此处返回用户列表', '.layui-layer-setwin .layui-layer-close', {
                        tips: 3
                    });
                },500)
            },
            end:function(){
                location.reload();
            }
        })
        // layui.layer.full(index);
        //改变窗口大小时，重置弹窗的宽高，防止超出可视区域（如F12调出debug的操作）
        $(window).on("resize",function(){
            layui.layer.full(index);
        })
    }

    $(".addNews_btn").click(function(){
        addUser();
    })


    //列表操作
    table.on('tool(userList)', function(obj){
        var layEvent = obj.event,
            data = obj.data;
        if(layEvent === 'edit'){ //编辑
            addUser(data);
        }else if(layEvent === 'del'){ //删除
            layer.confirm('确定删除此用户？',{icon:3, title:'提示信息'},function(index){
                // $.get("删除文章接口",{
                //     newsId : data.newsId  //将需要删除的newsId作为参数传入
                // },function(data){
                    tableIns.reload();
                    layer.close(index);
                // })
            });
        }
    });

    //批量删除
    $(".delAll_btn").click(function(){
        var checkStatus = table.checkStatus('userListTable'),
            data = checkStatus.data,
            newsId = [];
        if(data.length > 0) {
            for (var i in data) {
                newsId.push(data[i].newsId);
            }
            layer.confirm('确定删除选中的用户？', {icon: 3, title: '提示信息'}, function (index) {
                // $.get("删除文章接口",{
                //     newsId : newsId  //将需要删除的newsId作为参数传入
                // },function(data){
                tableIns.reload();
                layer.close(index);
                // })
            })
        }else{
            layer.msg("请选择需要删除的用户");
        }
    })

})