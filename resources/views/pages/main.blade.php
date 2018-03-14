@extends('layouts.app')
@section('title','首页')
@section('style')
    <link rel="stylesheet" href="{{ asset('layui/css/layui.css') }}" media="all" />
    <link rel="stylesheet" href="{{ asset('css/public.css') }}" media="all" />
    @endsection
@section('body')
<blockquote class="layui-elem-quote layui-bg-green">
    <div id="nowTime"></div>
</blockquote>
<div class="layui-row layui-col-space10 panel_box">
    <div class="panel layui-col-xs12 layui-col-sm6 layui-col-md4 layui-col-lg2">
        <a href="javascript:;" data-url="http://blog.work/" target="_blank">
            <div class="panel_icon layui-bg-green">
                <i class="layui-anim seraph icon-good"></i>
            </div>
            <div class="panel_word">
                <span>分类</span>
                <cite>分类说明</cite>
            </div>
        </a>
    </div>
    <div class="panel layui-col-xs12 layui-col-sm6 layui-col-md4 layui-col-lg2">
        <a href="javascript:;" data-url="http://blog.work/" target="_blank">
            <div class="panel_icon layui-bg-black">
                <i class="layui-anim seraph icon-github"></i>
            </div>
            <div class="panel_word">
                <span>分类</span>
                <cite>分类说明</cite>
            </div>
        </a>
    </div>
    <div class="panel layui-col-xs12 layui-col-sm6 layui-col-md4 layui-col-lg2">
        <a href="javascript:;" data-url="http://blog.work/" target="_blank">
            <div class="panel_icon layui-bg-red">
                <i class="layui-anim seraph icon-oschina"></i>
            </div>
            <div class="panel_word">
                <span>分类</span>
                <cite>分类说明</cite>
            </div>
        </a>
    </div>
    <div class="panel layui-col-xs12 layui-col-sm6 layui-col-md4 layui-col-lg2">
        <a href="javascript:;" data-url="http://blog.work/">
            <div class="panel_icon layui-bg-orange">
                <i class="layui-anim seraph icon-icon10" data-icon="icon-icon10"></i>
            </div>
            <div class="panel_word userAll">
                <span></span>
                <em>用户总数</em>
                <cite class="layui-hide">用户中心</cite>
            </div>
        </a>
    </div>
    <div class="panel layui-col-xs12 layui-col-sm6 layui-col-md4 layui-col-lg2">
        <a href="javascript:;" data-url="http://blog.work/">
            <div class="panel_icon layui-bg-cyan">
                <i class="layui-anim layui-icon" data-icon="&#xe857;">&#xe857;</i>
            </div>
            <div class="panel_word outIcons">
                <span></span>
                <em>外部图标</em>
                <cite class="layui-hide">图标管理</cite>
            </div>
        </a>
    </div>
    <div class="panel layui-col-xs12 layui-col-sm6 layui-col-md4 layui-col-lg2">
        <a href="javascript:;">
            <div class="panel_icon layui-bg-blue">
                <i class="layui-anim seraph icon-clock"></i>
            </div>
            <div class="panel_word">
                <span class="loginTime"> {{ $user->last_login_in }}</span>
                <cite>上次登录时间</cite>
            </div>
        </a>
    </div>
</div>
<div class="layui-row layui-col-space10">
    <div class="layui-col-lg6 layui-col-md12">
        <blockquote class="layui-elem-quote title">系统基本参数</blockquote>
        <table class="layui-table magt0">
            <colgroup>
                <col width="150">
                <col>
            </colgroup>
            <tbody>
            <tr>
                <td>网站首页</td>
                <td class="homePage">{{ config('app.url') }}</td>
            </tr>
            <tr>
                <td>操作系统</td>
                <td class="homePage">{{ PHP_OS }}</td>
            </tr>
            <tr>
                <td>服务器环境</td>
                <td class="server">{{ php_uname() }}</td>
            </tr>
            <tr>
                <td>PHP版本</td>
                <td class="author">{{ 'PHP/'.PHP_VERSION }}</td>
            </tr>
            <tr>
                <td>运行环境</td>
                <td class="dataBase">{{ array_get($_SERVER, 'SERVER_SOFTWARE') }}</td>
            </tr>
            <tr>
                <td>最大上传限制</td>
                <td class="maxUpload">{{ get_cfg_var ("upload_max_filesize")?get_cfg_var ("upload_max_filesize"):'' }}</td>
            </tr>
            <tr>
                <td>执行时间限制</td>
                <td class="userRights">{{ get_cfg_var("max_execution_time")."秒 " }}</td>
            </tr>
            <tr>
                <td>服务器系统时间</td>
                <td class="userRights">{{ date("Y-m-d G:i:s") }}</td>
            </tr>
            </tbody>
        </table>
        <blockquote class="layui-elem-quote title">最新文章 <i class="layui-icon layui-red">&#xe756;</i></blockquote>
        <table class="layui-table mag0" lay-skin="line">
            <colgroup>
                <col>
                <col width="110">
            </colgroup>
            <tbody class="hot_news"></tbody>
        </table>
    </div>
    <div class="layui-col-lg6 layui-col-md12">
        <blockquote class="layui-elem-quote title">发展历程&更新日志</blockquote>
        <div class="layui-elem-quote layui-quote-nm history_box magb0">
            <ul class="layui-timeline">
                <li class="layui-timeline-item">
                    <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
                    <div class="layui-timeline-content layui-text">
                        <div class="layui-timeline-title">
                            <h3 class="layui-inline">J-blog V1.0 正式与大家见面，提供了一些简单功能　</h3>
                            <span class="layui-badge-rim">2018-03-13</span>
                        </div>
                        <ul>
                            <li># v1.0（优化） - 2018-03-13</li>
                            <li>修改刚进入页面无任何操作时按回车键提示“请输入解锁密码！”</li>

                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript" src="{{ asset('layui/layui.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
@endsection