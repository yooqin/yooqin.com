<!DOCTYPE html>
<html lang="zh-CN">
	<head>
	<meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- user-scalable=no 禁用缩放功能 -->
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="generator" content="yooqin.com" />
    <meta name="keywords" content="@yield('meta-keywords')" />
    <meta name="description" content="@yield('meta-description')" />
	<title>@yield('meta-title')</title>

	<!-- Bootstrap -->
    <link href="{{ asset('static/bootstrap-3.3.7/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('static/css/core.css') }}" rel="stylesheet">
    @yield('css')
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	  <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	  <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

    <script>window.YOOQIN = {'csrf_token' : '{{csrf_token()}}'};</script>
	</head>
<body>
	<!-- start navigation -->
	<nav class="main-navigation">

		<div class="container">
			<div class="row">
				<div class="col-md-12" style="text-align:center;">
					<a href="http://www.yooqin.com" alt="优勤网" class='logo'><img src='{{ asset('static/images/logo.png') }}'></a>
				</div>
			</div>
		</div>
	</nav>
	<!-- end navigation -->
	
	<!-- start section -->
	<section class="content-warp">
		<div class="container">
			<div class="row">
				<main class="col-md-12 main-content">
                    <div class="post" style="text-align:center;">
                    <h1 style="color:#ea6000;"><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> Server errors!</h1>
                    <div style="padding:50px 0px;">
                    <a href="http://www.yooqin.com">>>去优勤网首页</a>
                    </div>
                    </div>
				</main>	
			</div>
		</div>
	</section>
	<!-- end section -->

	<div class="copyright">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">Copyright@www.yooqin.com | <a href="http://www.miibeian.gov.cn/" target="_blank">京ICP备15037850号-1</a></div>
			</div>
		</div>
	</div>

	<!-- go back -->
	<a href="#" id="back-to-top" title="嗖的滚上去~~" data-toggle="tooltip" data-placement="left">
		<span class="glyphicon glyphicon-menu-up" aria-hidden="true"></span>
	</a>

</body>
</html>
