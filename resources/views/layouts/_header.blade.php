<nav class="navbar navbar-expand-md navbar-light navbar-top sticky-top">
    <div class="container">
        <!-- logo Image -->
        <a class="navbar-brand" href="{{ url('/') }}">
            茄盒网
        </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#app-navbar-collapse" aria-controls="app-navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

        <div class="collapse navbar-collapse ml-4" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item {{ active_class(if_route('posts.index')) }}"><a class="nav-link" href="{{ route('posts.index') }}">首页</a></li>

                @foreach($categories as $category)
                <li class="nav-item {{ active_class((if_route('categories.show') && if_route_param('category', $category->id))) }}"><a class="nav-link" href="{{ route('categories.show', $category->id) }}">{{ $category->name }}</a></li>
                    @endforeach
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <a href="{{ url('socials/qq/authorizations') }}" ><img src="http://qzonestyle.gtimg.cn/qzone/vas/opensns/res/img/Connect_logo_7.png"></a>

                    <li><a class="nav-link" href="{{ route('login') }}"><img src="http://qzonestyle.gtimg.cn/qzone/vas/opensns/res/img/Connect_logo_7.png"></a></li>
                    <li><a class="nav-link" href="{{ route('register') }}">注册</a></li>
                    @else
                        @can('manage_contents')
                        <li>
                            <a class="nav-link create-fa" href="{{ route('posts.create') }}">
                                <span class="fas fa-plus" aria-hidden="true"></span>
                            </a>
                        </li>
                        @endcan
                        {{-- 消息通知标记 --}}
                        <li>
                            <a class="nav-link notifications-badge" href="{{ route('notifications.index') }}">
                            <span class="badge badge-{{ Auth::user()->notification_count > 0 ? 'danger' : 'dark' }} " title="消息提醒">
                                {{ Auth::user()->notification_count }}
                            </span>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="user-avatar" style="margin-right:8px; margin-top:-5px;">
                                <img src="{{ Auth::user()->avatar }}" class="rounded" style="height: 30px;width: 30px">
                            </span>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right">
                        @can('manage_contents')
                                    <button class="dropdown-item" type="button"><a class="dropdown-item" href="{{ url(config('administrator.uri')) }}"><i class="fab fa-dashcube"></i> 管理后台</a>
                                    </button>
                        @endcan
                                <button class="dropdown-item" type="button"><a class="dropdown-item" href="{{ route('users.show', Auth::id()) }}"><i class="far fa-user"></i>个人中心</a>
                                </button>
                                <button class="dropdown-item" type="button"><a class="dropdown-item" href="{{ route('users.edit', Auth::id()) }}"><i class="far fa-edit"></i>编辑资料</a>
                                </button>
                                <button class="dropdown-item" type="button"><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i>退出登录</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form></button>
                            </div>

                        </li>
                        @endguest
            </ul>
        </div>
    </div>
</nav>
