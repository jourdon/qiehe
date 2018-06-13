<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', '茄盒网') - {{ setting('site_name', '茄盒网') }}</title>
    <meta name="description" content="@yield('description', setting('seo_description', '茄盒网'))" />
    <meta name="keyword" content="@yield('keyword', setting('seo_keyword', 'Jourdon,blog,茄盒网'))" />
    <link rel="shortcut icon" href="/favicon.png">
    <!-- Styles -->
    <link href="https://lib.baomitu.com/font-awesome/5.0.8/web-fonts-with-css/css/fontawesome-all.min.css" rel="stylesheet">
    @yield('style')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body>
<div id="app" class="{{ route_class() }}-page">

    @include('layouts._header')

    <div class="container">

        @include('layouts._message')
        @yield('content')

    </div>

    @include('layouts._footer')
</div>

@if (app()->isLocal())
    @include('sudosu::user-selector')
@endif

<!-- Scripts -->

<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/prism.js') }}"></script>
@yield('scripts')
<script>
    var _hmt = _hmt || [];
    (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?523c03866798766abb1c6d68b98d8a72";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);

        var bp = document.createElement('script');
        var curProtocol = window.location.protocol.split(':')[0];
        if (curProtocol === 'https') {
            bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';
        }
        else {
            bp.src = 'http://push.zhanzhang.baidu.com/push.js';
        }
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(bp, s);
    })();
</script>
<!--返回顶部-->
<div id="code"></div>
<div id="code_img"></div>
<a id="gotop" href="javascript:void(0)"><img src="{{asset('images/top.png')}}" alt=""/></a>
<script type="text/javascript">
    function b(){
        h = $(window).height();
        t = $(document).scrollTop();
        if(t > h){
            $('#gotop').show();
        }else{
            $('#gotop').hide();
        }
    }
    $(document).ready(function(e) {

        b();

        $('#gotop').click(function(){
            $(document).scrollTop(0);
        });

        $('#code').hover(function(){
            $(this).attr('id','code_hover');
            $('#code_img').show();
            $('#code_img').addClass('a-fadeinL');
        },function(){
            $(this).attr('id','code');
            $('#code_img').hide();
        })

    });

    $(window).scroll(function(e){
        b();
    });
</script>
<!--返回顶部结束-->
</body>
</html>