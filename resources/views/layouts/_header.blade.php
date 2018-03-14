<div class="layui-main mag0">
    <a href="#" class="logo">J-blog</a>
    <!-- 显示/隐藏菜单 -->
    <a href="javascript:;" class="seraph hideMenu icon-caidan"></a>
    <!-- 顶级菜单 -->
    <ul class="layui-nav mobileTopLevelMenus" mobile>
        <li class="layui-nav-item" data-menu="contentManagement">
            <a href="javascript:;"><i class="seraph icon-caidan"></i><cite>J-blog</cite></a>
            <dl class="layui-nav-child">
                @foreach($parent_navs as $k=>$item)
                <dd {{ $k==0 ? "class=layui-this" :'' }} data-menu="{{ $item['name_en'] }}">
                    <a href="javascript:;">
                        <i class="layui-icon" data-icon="{{ $item['icon'] }}">{{ $item['icon'] }}</i>
                        <cite>{{ $item['title'] }}{{$k}}</cite>
                    </a>
                </dd>
                @endforeach
            </dl>
        </li>
    </ul>
    <ul class="layui-nav topLevelMenus" pc>
        @foreach($parent_navs as $k=>$item)
        <li class="layui-nav-item {{ $k==0? "layui-this" :'' }}" data-menu="{{ $item['name_en'] }}">
            <a href="javascript:;"><i class="layui-icon" data-icon="{{ $item['icon'] }}">{{ $item['icon'] }}</i><cite>{{ $item['title'] }}</cite></a>
        </li>
        @endforeach
    </ul>
    <!-- 顶部右侧菜单 -->
    <ul class="layui-nav top_menu">
        <li class="layui-nav-item" pc>
            <a href="javascript:;" class="clearCache"><i class="layui-icon" data-icon="&#xe640;">&#xe640;</i><cite>清除缓存</cite><span class="layui-badge-dot"></span></a>
        </li>
        <li class="layui-nav-item lockcms" pc>
            <a href="javascript:;"><i class="seraph icon-lock"></i><cite>锁屏</cite></a>
        </li>
        <li class="layui-nav-item" id="userInfo">
            <a href="javascript:;"><img src="{{ $user->avatar }}" class="layui-nav-img userAvatar" width="35" height="35"><cite class="adminName">{{ $user->name }}</cite></a>
            <dl class="layui-nav-child">
                <dd><a href="javascript:;" data-url="page/user/userInfo.html"><i class="seraph icon-ziliao" data-icon="icon-ziliao"></i><cite>个人资料</cite></a></dd>
                <dd><a href="javascript:;" data-url="page/user/changePwd.html"><i class="seraph icon-xiugai" data-icon="icon-xiugai"></i><cite>修改密码</cite></a></dd>
                <dd><a href="javascript:;" class="showNotice"><i class="layui-icon">&#xe645;</i><cite>系统公告</cite><span class="layui-badge-dot"></span></a></dd>
                <dd pc><a href="javascript:;" class="functionSetting"><i class="layui-icon">&#xe620;</i><cite>功能设定</cite><span class="layui-badge-dot"></span></a></dd>
                <dd pc><a href="javascript:;" class="changeSkin"><i class="layui-icon">&#xe61b;</i><cite>更换皮肤</cite></a></dd>


                <dd><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="signOut"><i class="seraph icon-tuichu"></i><cite>退出</cite></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </dd>


            </dl>
        </li>
    </ul>
</div>