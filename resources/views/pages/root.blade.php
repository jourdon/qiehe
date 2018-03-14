@extends('layouts.app')
@section('title','后台首页')
@section('style')
    <link rel="stylesheet" href="{{ asset('layui/css/layui.css') }}" media="all" />
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" media="all" />
@endsection

@section('body')
    <!-- 顶部 -->
    <div class="layui-header header">
        @include('layouts._header')
    </div>
    <!-- 左侧导航 -->
    <div class="layui-side layui-bg-black">
        @include('layouts._left')
    </div>
    <!-- 右侧内容 -->
    <div class="layui-body layui-form">
        <div class="layui-tab mag0" lay-filter="bodyTab" id="top_tabs_box">
            <ul class="layui-tab-title top_tab" id="top_tabs">
                <li class="layui-this" lay-id=""><i class="layui-icon">&#xe68e;</i> <cite>后台首页</cite></li>
            </ul>
            <ul class="layui-nav closeBox">
                <li class="layui-nav-item">
                    <a href="javascript:;"><i class="layui-icon caozuo">&#xe643;</i> 页面操作</a>
                    <dl class="layui-nav-child">
                        <dd><a href="javascript:;" class="refresh refreshThis"><i class="layui-icon">&#x1002;</i> 刷新当前</a></dd>
                        <dd><a href="javascript:;" class="closePageOther"><i class="seraph icon-prohibit"></i> 关闭其他</a></dd>
                        <dd><a href="javascript:;" class="closePageAll"><i class="seraph icon-guanbi"></i> 关闭全部</a></dd>
                    </dl>
                </li>
            </ul>
            <div class="layui-tab-content clildFrame">
                <div class="layui-tab-item layui-show">
                    <iframe src="{{ url('admin/main') }}"></iframe>
                </div>
            </div>
        </div>
    </div>

    <!-- 底部 -->
    <div class="layui-footer footer">
        @include('layouts._footer')
    </div>
    @endsection

@section('moblie')
    <!-- 移动导航 -->
    <div class="site-tree-mobile"><i class="layui-icon">&#xe602;</i></div>
    <div class="site-mobile-shade"></div>
    @endsection

@section('script')
    <script type="text/javascript" src="{{ asset('layui/layui.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/index.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/cache.js') }}"></script>
@endsection







