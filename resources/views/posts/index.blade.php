@extends('layouts.app')
@section('title','文章列表')
@section('style')
    <link rel="stylesheet" href="{{ asset('layui/css/layui.css') }}" media="all" />
    <link rel="stylesheet" href="{{ asset('css/public.css') }}" media="all" />
@endsection
@section('body')
    <form class="layui-form">
        <blockquote class="layui-elem-quote quoteBox">
            <form class="layui-form">
                <div class="layui-inline">
                    <div class="layui-input-inline">
                        <input type="text" class="layui-input searchVal" placeholder="请输入搜索的内容" />
                    </div>
                    <a class="layui-btn search_btn" data-type="reload">搜索</a>
                </div>
                <div class="layui-inline">
                    <a class="layui-btn layui-btn-normal addNews_btn">添加文章</a>
                </div>
                <div class="layui-inline">
                    <a class="layui-btn layui-btn-danger layui-btn-normal delAll_btn">批量删除</a>
                </div>
            </form>
        </blockquote>
        <table id="newsList" lay-filter="newsList"></table>
        <!--审核状态-->
        <script type="text/html" id="newsStatus">
            @{{#  if(d.status == "0"){ }}
            <span class="layui-blue">已存草稿</span>
            @{{#  } else { }}
            正常发布
            @{{#  }}}
        </script>
        <script type="text/html" id="newsLook">
            @{{#  if(d.look == "0"){ }}
            <span class="layui-red">私密浏览</span>
            @{{#  } else { }}
            开放浏览
            @{{#  }}}
        </script>

        <!--操作-->
        <script type="text/html" id="newsListBar">
            <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
            <a class="layui-btn layui-btn-xs layui-btn-danger" lay-event="del">删除</a>
            <a class="layui-btn layui-btn-xs layui-btn-primary" lay-event="look">预览</a>
        </script>
    </form>
@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('layui/layui.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/newsList.js?1.3') }}"></script>
@endsection
