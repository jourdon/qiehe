@extends('layouts.app')
@section('title',"{{ $user->id?'编辑用户':'新建用户' }}")
@section('style')
    <link rel="stylesheet" href="{{ asset('layui/css/layui.css') }}" media="all" />
    <link rel="stylesheet" href="{{ asset('css/public.css') }}" media="all" />
@endsection
@section('body')

    <form class="layui-form"  method="POST">
        @if($user->id)
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="action" value="{{ route('users.update', $user->id) }}">
        @else
        <input type="hidden" name="action" value="{{ route('users.store') }}">
        @endif
        {{ csrf_field() }}


            <div class="layui-form-item layui-row layui-col-xs12">
                <label class="layui-form-label" id="useravatar">用户头像</label>
                <div class="layui-upload-list">
                    <img class="layui-upload-img layui-circle userFaceBtn " id="userFace" src="{{ $user->avatar }}">
                </div>
            </div>

        <div class="layui-form-item layui-row layui-col-xs12">
            <label class="layui-form-label">用户名</label>
            <div class="layui-input-block">
                <input type="text" name="username" class="layui-input userName" lay-verify="required" placeholder="请输入登录名" value="{{ old('name', $user->name ) }}" id="usernametips">
            </div>
        </div>
        <div class="layui-form-item layui-row layui-col-xs12">
            <label class="layui-form-label">邮箱</label>
            <div class="layui-input-block">
                <input type="text" name="email" class="layui-input userEmail" lay-verify="email" placeholder="请输入邮箱" value="{{ old('name', $user->email ) }}">
            </div>
        </div>
        <div class="layui-form-item layui-row layui-col-xs12">
            <label class="layui-form-label">密码</label>
            <div class="layui-input-block">
                <input type="pasword" name="password" class="layui-input" lay-verify="password" placeholder="如不更改可留空" value="{{ old(' password',$user->password ) }}">
            </div>
        </div>
        <div class="layui-form-item layui-row layui-col-xs12">
            <label class="layui-form-label">性别</label>
            <div class="layui-input-block userSex">
                <input type="radio" name="sex" value="1" title="男" {{ old('sex', $user->sex )==1 ?'checked':'' }}>
                <input type="radio" name="sex" value="0" title="女" {{ old('sex', $user->sex )==0 ?'checked':'' }}>
            </div>
        </div>
        <div class="layui-form-item layui-row layui-col-xs12">
            <label class="layui-form-label">会员等级</label>
            <div class="layui-input-block">
                <select  class="userGrade" lay-filter="userGrade" name="is_admin" @if($user->id==1) disabled @endif>
                    <option value="1" {{ old('status', $user->is_admin )==1?'selected':'' }}>管理员</option>
                    <option value="0" {{ old('status', $user->is_admin )==0?'selected':'' }}>注册会员</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item layui-row layui-col-xs12">
            <label class="layui-form-label">会员状态</label>
            <div class="layui-input-block">
                <select name="status" class="userStatus" lay-filter="userStatus" @if($user->id==1) disabled @endif>
                    <option value="1" {{ old('status', $user->status )==1?'selected':'' }}>正常使用</option>
                    <option value="0" {{ old('status', $user->status )==0?'selected':'' }}>限制用户</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item layui-row layui-col-xs12">
            <div class="layui-input-block">
                <button class="layui-btn layui-btn-sm" lay-submit="" lay-filter="addUser">提交</button>
                <button type="reset" class="layui-btn layui-btn-sm layui-btn-primary">取消</button>
            </div>
        </div>
    </form>
@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('layui/layui.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/userAdd.js?1.9') }}"></script>
@endsection
