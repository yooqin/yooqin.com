<!DOCTYPE html>
<html lang="zh-CN">
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- user-scalable=no 禁用缩放功能 -->
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<title>个人中心 - 优勤网</title>

	<!-- Bootstrap -->
    <link href="{{ asset('static/bootstrap-3.3.7/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('static/css/core.css') }}" rel="stylesheet">
    <link href="{{ asset('static/amd/adm.css') }}" rel="stylesheet">

    @yield('css')

	<!--[if lt IE 9]>
	  <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	  <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
	</head>
<body>
	<!-- start navigation -->
	<nav class="main-navigation">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<a href="/" class='logo usercenter' style="line-height:80px;">
                        <img src='{{ asset('static/images/logo-admin.png') }}' />
                    </a>
				</div>
                <div class="col-md-3"></div>
				<div class="col-md-6">
					<div class="navbar-header">
						<span class="nav-toggle-button collapsed" data-toggle="collapse" data-target="#main-menu">
							<span class="sr-only">打开菜单</span>
							<span class="glyphicon glyphicon-th-list open-menu" aria-hidden="true"></span>
						</span>
					</div>
					<div class="collapse navbar-collapse" id="main-menu">
						<ul class="menu">
                        @if (Auth::guest())
                            <li class="nav-current"><a href="{{ route('login') }}">登录</a></li>
                            <li class="presentation"><a href="{{ route('register') }}">注册</a></li>
                        @else
                            <li class="nav-current"><a href="{{ route('home') }}">个人中心</a></li>
                            <li class="presentation"><a href="/adm/blog">博客管理</a></li>
                            <li class="presentation"><a href="/adm/article">资讯管理</a></li>
                            <li class="presentation">
                                <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                            </li>
                        @endif 
						</ul>
					</div>
				</div>
			</div>
		</div>
		
	</nav>

    @yield('nav-content')

	<!-- start section -->
	<section class="content-warp">
		<div class="container">
		    <main class="adm-main-content">
            @yield('content')
			</main>	
		</div>
	</section>
	<!-- end section -->

	<!-- start footer -->
	<footer class="main-footer">
	<!-- end footer -->
	<div class="copyright">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">Copyright@www.yooqin.com | <a href="">京ICP20150608</a></div>
			</div>
		</div>
	</div>
	</footer>	

	<!-- go back -->
	<a href="#" id="back-to-top" title="嗖的滚上去~~" data-toggle="tooltip" data-placement="left">
		<span class="glyphicon glyphicon-menu-up" aria-hidden="true"></span>
	</a>

	
	<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
	<script src="{{ asset('static/bootstrap-3.3.7/js/bootstrap.min.js') }}"></script>

    @yield('js')

	</body>
</html>
