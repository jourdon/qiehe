layui.use(['form','layer','upload'],function(){
    var form = layui.form,
        // layer = parent.layer === undefined ? layui.layer : top.layer,
        layer = layui.layer,
        upload = layui.upload,
        $ = layui.jquery;
    var _token=$('meta[name="csrf-token"]').attr('content');

    layer.msg('点击头像即可更改头像', {
        offset: ['100px', '120px'],
        time:3000,
    });

    form.on("submit(addUser)",function(data){
        console.log(data.field);
        console.log(data.field.password);

        //弹出loading
        // var index = top.layer.msg('数据提交中，请稍候',{icon: 16,time:false,shade:0.8});
        //实际使用时的提交信息

        $.ajax({
            url : data.field.action,
            type : data.field._method?data.field._method:"post",
            data:{
                name:data.field.username,
                email:data.field.email,
                password:data.field.password,
                sex:data.field.sex,
                status:data.field.status,
                is_admin:data.field.is_admin,
                avatar:data.field.avatar,
                _token:data.field._token,
            },
            success : function(data){
                console.log('成功');
                top.layer.msg("用户编辑成功！");
                    layer.closeAll();
                return false;
            },
            error:function(data){
                console.log('error');
                top.layer.msg("用户修改失败！");
                layer.closeAll();
                return false;
            }
        });
        // setTimeout(function(){
        //     top.layer.close(index);
        //     top.layer.msg("用户添加成功！");
        //     layer.closeAll("iframe");
        //     //刷新父页面
        //     parent.location.reload();
        // },2000);
        return false;
    })

    //格式化时间
    function filterTime(val){
        if(val < 10){
            return "0" + val;
        }else{
            return val;
        }
    }
    //定时发布
    // var time = new Date();
    // var submitTime = time.getFullYear()+'-'+filterTime(time.getMonth()+1)+'-'+filterTime(time.getDate())+' '+filterTime(time.getHours())+':'+filterTime(time.getMinutes())+':'+filterTime(time.getSeconds());

    //上传头像
    upload.render({
        elem: '.userFaceBtn',
        url: '/admin/image_upload',
        method : "post",  //此处是为了演示之用，实际使用中请将此删除，默认用post方式提交
        data:{_token:_token},
        done: function(res, index, upload){

            console.log(res);
            console.log(index);
            console.log(upload);


            // var num = parseInt(4*Math.random());  //生成0-4的随机数，随机显示一个头像信息
            $('#userFace').attr('src',res.data.src);
            var src ="<input type='text' name='avatar' value='"+res.data.src+"' style='display:none'>";
            $('#userFace').before(src);
            // window.sessionStorage.setItem('userFace',res.data[num].src);
            layer.msg(res.msg);
        }
    });
})