layui.use(['form','layer','jquery'],function(){
    var form = layui.form,
        layer = parent.layer === undefined ? layui.layer : top.layer
        $ = layui.jquery;

    //登录按钮 ======完成======
    form.on("submit(login)",function(data){
        // $(this).text("登录中...").attr("disabled","disabled").addClass("layui-disabled");
        console.log(data.field);
        $.ajax({
            url : "/login",
            type : "post",
            data:{name:data.field.username,password:data.field.password,code:data.field.code,_token:data.field._token},
            // dataType : "json",
            success : function(data){
                // console.log(data);
                    window.location.href = "/admin";

                // return false;
            },
            error:function(data){
                // console.log(data);
                if(data.responseJSON.errors){
                    layer.msg(data.responseJSON.message, {icon: 5,anim: 6});
                }else{
                    layer.msg(data.statusText, {icon: 5,anim: 6});
                }
            }
        })
        return false;
    })

    //表单输入效果
    $(".loginBody .input-item").click(function(e){
        e.stopPropagation();
        $(this).addClass("layui-input-focus").find(".layui-input").focus();
    })
    $(".loginBody .layui-form-item .layui-input").focus(function(){
        $(this).parent().addClass("layui-input-focus");
    })
    $(".loginBody .layui-form-item .layui-input").blur(function(){
        $(this).parent().removeClass("layui-input-focus");
        if($(this).val() != ''){
            $(this).parent().addClass("layui-input-active");
        }else{
            $(this).parent().removeClass("layui-input-active");
        }
    })
})
