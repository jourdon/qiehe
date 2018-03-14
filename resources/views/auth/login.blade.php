<!DOCTYPE html>
<html class="loginHtml">
<head>
    <meta charset="utf-8">
    <title>登录--layui后台管理模板 2.0</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('layui/css/layui.css') }}" media="all" />
    <link rel="stylesheet" href="{{ asset('css/public.css') }}" media="all" />
</head>
<body class="loginBody">
<form class="layui-form" method="post" action="{{ url('login') }}">
    {{csrf_field()}}
    <div class="layui-form-item input-item">
        <label for="userName">用户名</label>
        <input type="text" name="username" placeholder="请输入用户名" autocomplete="off" id="userName" class="layui-input" lay-verify="required" value="admin">
    </div>
    <div class="layui-form-item input-item">
        <label for="password">密码</label>
        <input type="password" name="password" placeholder="请输入密码" autocomplete="off" id="password" class="layui-input" lay-verify="required" value="password">
    </div>
    <div class="layui-form-item input-item" id="imgCode">
        <label for="code">验证码</label>
        <input type="text" name="code" placeholder="请输入验证码" autocomplete="off" id="code" class="layui-input" lay-verify="required" value="123">
        <img src="../../images/code.jpg">
    </div>
    <div class="layui-form-item">
        <button class="layui-btn layui-block" lay-filter="login" lay-submit>登录</button>
    </div>
</form>
<script type="text/javascript" src="{{ asset('layui/layui.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/login.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/cache.js') }}"></script>
</body>
</html>