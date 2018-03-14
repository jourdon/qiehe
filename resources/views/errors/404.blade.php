<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>404页面</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="{{ asset('layui/css/layui.css') }}" media="all" />
    <link rel="stylesheet" href="{{ asset('css/public.css') }}" media="all" />
</head>
<body class="childrenBody">
<div class="noFind">
    <div class="ufo">
        <i class="seraph icon-test ufo_icon"></i>
        <i class="layui-icon page_icon">&#xe638;</i>
    </div>
    <div class="page404">
        <i class="layui-icon">&#xe61c;</i>
        {{--<p>{{ $expection  }}</p>--}}
        <p>{{ $msg ?:'我勒个去，页面被外星人挟持了!' }}</p>
        {{--<p>{{ $code}}</p>--}}
    </div>
</div>
<script type="text/javascript" src="{{ asset('layui/layui.js') }}"></script>
<script>
    layui.use(['layer','jquery'],function() {
        var layer = parent.layer === undefined ? layui.layer : top.layer;

        var code = "{{ $code }}";
        var msg = "{{ $msg }}";
        if(code==401){
            layer.msg(msg,{icon: 5});
            setTimeout(function(){
                window.location.href = "/";
            },1500);
        }
    })
</script>
</body>
</html>