<div class="user-photo">
    <a class="img" title="我的头像" ><img src="{{ $user->avatar }}" class="userAvatar"></a>
    <p>你好！<span class="userName">{{ $user->name }}</span>, 欢迎登录</p>
</div>
<!-- 搜索 -->
<div class="layui-form component">
    <select name="search" id="search" lay-search lay-filter="searchPage">
        <option value="">搜索页面或功能</option>
        <option value="1">layer</option>
        <option value="2">form</option>
    </select>
    <i class="layui-icon">&#xe615;</i>
</div>
<div class="navBar layui-side-scroll" id="navBar">
    <ul class="layui-nav layui-nav-tree">
        <li class="layui-nav-item layui-this">
            <a href="javascript:;" data-url="page/main.html"><i class="layui-icon" data-icon=""></i><cite>后台首页</cite></a>
        </li>
    </ul>
</div>