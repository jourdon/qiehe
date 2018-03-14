@extends('layouts.app')
@section('title','用户中心')
@section('style')
	<link rel="stylesheet" href="{{ asset('layui/css/layui.css') }}" media="all" />
	<link rel="stylesheet" href="{{ asset('css/public.css') }}" media="all" />
@endsection
@section('body')
	<form class="layui-form">
		<blockquote class="layui-elem-quote quoteBox">
			<form class="layui-form">
				{{csrf_field()}}
				<div class="layui-inline">
					<div class="layui-input-inline">
						<input type="text" class="layui-input searchVal" placeholder="请输入搜索的内容" />
					</div>
					<a class="layui-btn search_btn" data-type="reload">搜索</a>
				</div>
				<div class="layui-inline">
					<a class="layui-btn layui-btn-normal addNews_btn">添加用户</a>
				</div>
				<div class="layui-inline">
					<a class="layui-btn layui-btn-danger layui-btn-normal delAll_btn">批量删除</a>
				</div>
			</form>
		</blockquote>
		<table id="userList" lay-filter="userList"></table>

		<!--操作-->
		<script type="text/html" id="userListBar">
			<a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
			<a class="layui-btn layui-btn-xs layui-btn-warm" lay-event="usable">已启用</a>
			<a class="layui-btn layui-btn-xs layui-btn-danger" lay-event="del">删除</a>
		</script>
	</form>
@endsection
@section('script')
	<script type="text/javascript" src="{{ asset('layui/layui.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/userList.js?2.0') }}"></script>
@endsection