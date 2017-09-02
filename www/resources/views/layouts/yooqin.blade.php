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
    <link href="{{ asset('static/libs/sweetalert/sweetalert.css') }}" rel="stylesheet">
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
	<!-- start header -->
    <!--
	<header class="main-header">
		<div class="container header">
			<div class="row">
				<div class="col-md-12">
				</div>
			</div>
		</div>
	</header>
    -->
	<!-- end header -->
	
	<!-- start navigation -->
	<nav class="main-navigation">

		<div class="container">
			<div class="row">
				<div class="col-md-2">
					<a href="http://www.yooqin.com" alt="优勤网" class='logo'><img src='{{ asset('static/images/logo.png') }}'></a>
				</div>
				<div class="col-md-7">
					<div class="navbar-header">
						<span class="nav-toggle-button collapsed" data-toggle="collapse" data-target="#main-menu">
							<span class="sr-only">打开菜单</span>
							<span class="glyphicon glyphicon-th-list open-menu" aria-hidden="true"></span>
						</span>
					</div>
					<div class="collapse navbar-collapse" id="main-menu">
						<ul class="menu">
                            <li class="
                            @if($route_info['uri'] == '/')
                            nav-current
                            @else
                            presentation
                            @endif
                            " role="presentation"><a href="http://www.yooqin.com">首页</a></li>
                            <li class="
                            @if(strpos($route_info['uri'], 'blog') !== false)
                            nav-current
                            @else
                            presentation
                            @endif
                            "><a href="/blog">博客</a></li>
                            <li class="
                            @if(strpos($route_info['uri'], 'comments') !== false)
                            nav-current
                            @else
                            presentation
                            @endif
                            "><a href="/comments">啦呱</a></li>
                            <!--
							<li class="presentation"><a href="news.html">资讯</a></li>
							<li class="presentation"><a href="tags.html">标签库</a></li>
							<li class="presentation"><a href="discuss.html">讨论</a></li>
							<li class="presentation"><a href="sites.html">站签</a></li>
                            -->
							<li class="presentation"><a href="/" class="btn-click-about">关于</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-3">
                    <!--
					<form class="form-inline search">
						<input type="email" class="form-control" placeholder="输入关键字" id="keywords">
						<button type="submit" class="btn btn-default">搜</button>
					</form>
                    -->
				</div>
			</div>
		</div>
		
	</nav>
	<!-- end navigation -->
	
	<!-- start section -->
	<section class="content-warp">
		<div class="container">
			<div class="row">
				<main class="col-md-8 main-content">
                    @yield('main-content')
				</main>	
				<aside class="col-md-4 sidebar">
                    @yield('aside-content')
				</aside>
			</div>
		</div>
	</section>
	<!-- end section -->

	<!-- start footer -->
	<footer class="main-footer">
		<div class="container">
			<div class="col-sm-4">
				<div class="widget">
					<h4 class="title">最新博客</h4>
					<div class="content recent-post">
                        @foreach($hot_blogs as $_item)
						<div class="recent-single-post">
							<a href="{{$_item['blog_uri']}}" class="post-title">{{$_item['title']}}</a>
							<div class="date">{{$_item['created_date']}}</div>
						</div>
                        @endforeach
					</div>	
				</div>
			</div>	
			<div class="col-sm-4">
				<div class="widget">
					<h4 class="title">分类</h4>
					<div class="content tag-cloud">
                        @foreach($category_list as $_item)
						<a href="/blog/category/{{$_item['id']}}">{{$_item['name']}}</a>
                        @endforeach
						<a href="/category">...</a>
					</div>
				</div>

                <div class="widget">
					<h4 class="title">功能</h4>
					<div class="content tag-cloud">
						<a href="/login">登录</a>
						<a href="/register">注册</a>
					</div>
				</div>

                <div class="widget">
					<h4 class="title">Sitemap</h4>
					<div class="content tag-cloud">
						<a href="/sitemap.html" target="_blank">sitemap.html</a>
						<a href="/sitemap.xml" target="_blank">sitemap.xml</a>
						<a href="/urllist.txt" target="_blank">urllist.txt</a>
					</div>
				</div>


			</div>	
			<div class="col-sm-4">
				<div class="widget">
					<h4 class="title">友情链接</h4>
					<div class="content tag-cloud friends">
						<a href="http://www.nqp.me" target="_blank">不忘却的记忆</a>
						<a href="http://www.xingdong365.com/" target="_blank">Action365博客</a>
						<a href="http://www.pksafe.cn/" target="_blank">键盘上的小飞侠</a>
						<a href="http://www.viphper.com" target="_blank">飞飞</a>
						<a href="http://www.yooqin.com" target="_blank">滕州·秦伟</a>
                        <a href="http://lusongsong.com/" target="_blank">卢松松博客</a>
					</div>
				</div>

			</div>	
		</div>
	</footer>	
	<!-- end footer -->

	<div class="copyright">
		<div class="container">
			<div class="row">
                <div class="col-sm-12">
                    Copyright@www.yooqin.com | 
                    <a href="http://www.miibeian.gov.cn/" target="_blank">京ICP备15037850号-1</a>
                    <script src="https://s22.cnzz.com/z_stat.php?id=1262983956&web_id=1262983956" language="JavaScript"></script>
                </div>
			</div>
		</div>
	</div>

	<!-- go back -->
	<a href="#" id="back-to-top" title="嗖的滚上去~~" data-toggle="tooltip" data-placement="left">
		<span class="glyphicon glyphicon-menu-up" aria-hidden="true"></span>
	</a>

    <!-- modal start -->
    <!-- Modal -->
    <div class="modal fade" id="modal-about">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">站点介绍</h4>
                </div>
                <div class="modal-body">
                    <h5>介绍</h5>
                    <p>博客信息为主通过网站增加别人信任度，个人介绍及日常笔记记录为主，适当扩展讨论、站签、页签功能，后期扩展视频教学模块，提供了解、学习个人品牌站。为日后其他网站开设奠定信任度基础。</p>
                    <h5>发展历程</h5>
                    <table class="table">
                        <thead>
                            <tr><th>时间</th><th>事件</th></tr>
                        </thead>
                        <tbody>
                            <tr><td>2015-02-03</td><td>www.yooqin.com 域名注册</td></tr>
                            <tr><td>2015-05-03</td><td>优勤博客上线</td></tr>
                            <tr><td>2017-02-03</td><td>优勤网上线</td></tr>
                            <tr><td>2017-10-03</td><td>访问量突破1***人次</td></tr>
                        </tbody>
                    </table>
                    <h5>主创人员</h5>
                    <div class="row about-people">
                        <div class="col-sm-4"><img src="{{ asset('static/images/head-qin.png') }}" alt="yooqin" class="img-circle" width="60px"></div>
                        <div class="col-sm-4">秦**</div>
                        <div class="col-sm-4">服务端开发工程师</div>
                    </div>
                    <div class="row about-people">
                        <div class="col-sm-4"><img src="{{ asset('static/images/head-qinqin.png') }}" alt="Sopha" class="img-circle" width="60px"></div>
                        <div class="col-sm-4">SophaQin</div>
                        <div class="col-sm-4">She said it was a secret</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>  

    <div class="modal fade" id="modal-contact">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">联系我们</h4>
                </div>
                <div class="modal-body">
                    <h5>渠道 <span class='small'>* 请说明来自yooqin.com</span></h5>
                    <table class="table">
                        <thead>
                            <tr><th>类型</th><th>用户名</th></tr>
                        </thead>
                        <tbody>
                            <tr><td>邮箱</td><td>yooqin@gmail.com</td></tr>
                            <tr><td>web</td><td>www.yooqin.com</td></tr>
                            <tr><td>地址</td><td>北京 海淀</td></tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>  

    <div class="modal fade" id="modal-share">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">点击或扫描分享</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-4"><img src="{{ asset('static/images/site.png') }}" alt="yooqin" class="img-thumbnail" width="160px"></div>
                        <div class="col-sm-4"><img src="{{ asset('static/images/site-article.png') }}" alt="yooqin" class="img-thumbnail" width="160px"></div>
                        <div class="col-sm-4"><img src="{{ asset('static/images/site-wechat.png') }}" alt="yooqin" class="img-thumbnail" width="160px"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div> 

    <!-- 通用模态框 -->
	<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="message-small">
    	<div class="modal-dialog modal-sm" role="document">
      		<div class="modal-content">
        		<div class="modal-header">
          			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          			<h4 class="modal-title" id="mySmallModalLabel">消息提示</h4>
        		</div>
        		<div class="modal-body"></div>
      		</div><!-- /.modal-content -->
    	</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->


    <!-- modal end -->
    <script src="{{ asset('static/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset('static/bootstrap-3.3.7/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('static/libs/sweetalert/sweetalert.min.js') }}"></script>
	<script src="{{ asset('static/js/message.js') }}"></script>
	<script src="{{ asset('static/js/yooqin.js') }}"></script>
	<script src="{{ asset('static/js/bb.js') }}"></script>
    <script type="text/javascript">
        bb.bindEvent();
    </script>
    @yield('js')
</body>
</html>
