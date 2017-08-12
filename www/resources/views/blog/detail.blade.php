@extends('layouts.yooqin')


@section('css')
<link href="{{ asset('static/editor.md-master/css/editormd.preview.min.css') }}" rel="stylesheet">
<link href="{{ asset('static/css/fix_md.css') }}" rel="stylesheet">
@endsection

@section('meta-title'){{$data['title']}} - 优勤网(www.yooqin.com)@endsection
@section('meta-description'){{trim($data['description'])}}@endsection
@section('meta-keywords'){{trim($data['keywords'])}}@endsection




@section('main-content')
<nav class="category" role="navigation">
    <ul class="menu">
        <li class="nav-current" role="presentation"><a href="http://www.yooqin.com">首页</a></li>
        <li class="presentation">\</li>
        <li class="presentation"><a href="/blog/category/{{$data['category_id']}}">{{$data['category_name']}}</a></li>
        <li class="presentation">\</li>
        <li class="presentation"><a href="{{$data['uri']}}">{{mb_strimwidth($data['title'], 0, 50, '..')}}</a></li>
    </ul>
</nav>
<!-- begin article -->
<article id="1" class="post">
    <div class="post-head">
        <h1 class="post-title"><a href="{{$data['uri']}}">{{$data['title']}}</a></h1>
        <div class="post-meta">
            <span class="author">作者: <a href="javascript:void(0);">{{$data['user']['name']}}</a></span>
            <time class="post-date" datetime="{{$data['created_date']}}" title="{{$data['created_date']}}">发布: {{$data['created_date']}}</time>
            <time class="post-update-date" datetime="{{$data['updated_date']}}" title="{{$data['updated_date']}}">更新: {{$data['updated_date']}}</time>
        </div>
    </div>
    <div class="post-content markdown-body">
		<?php
		echo $data['content']['content'];
		?>
    </div>
    <footer class="post-footer clearfix">
		<div class="pull-left tag-list">
            <span class="glyphicon glyphicon-tags" aria-hidden="true"></span>
            @if (!empty($data['tags']))
            @foreach ($data['tags'] as $_tag)
            <a href="/tag/{{$_tag['id']}}">{{$_tag['name']}}</a>
            @endforeach
            @else
            <a href="javascript:void(0);">无</a>
            @endif
            <span class="glyphicon glyphicon-folder-open s20" aria-hidden="true"></span>
            <a href="/blog/category/{{$data['category_id']}}">{{$data['category_name']}}</a>
            <span class="glyphicon glyphicon-star s20 yellow" aria-hidden="true"></span>
            <a href="javascript:void(0);">{{$data['views']}}</a>
        </div>
        <div class="pull-right share">
            <a href="" class="btn-click-share"><span class="glyphicon glyphicon-send" aria-hidden="true"></span></a>
        </div>
	</footer>
</article>
<!-- end article -->

<div class="comments clearfix">
    <form class="form-horizontal">
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">姓名</label>
            <div class="col-sm-10">
                <input type="name" class="form-control" id="name" placeholder="姓名 / 昵称 / 匿名">
            </div>
        </div>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">联系方式</label>
            <div class="col-sm-10">
                <input type="contact" class="form-control" id="contact" placeholder="Email / QQ / 微信">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">评论内容</label>
            <div class="col-sm-10">
                <textarea class="form-control" rows="3" name="content"></textarea> 
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default btn-click-post-comments">提交评论</button>
            </div>
        </div>
    </form>
	<div class="comment">
		* 暂无评论
	</div>
	<!--
    <div class="comment">
            <p class="comment-fe">
            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
            秦伟
            <span class="glyphicon glyphicon-phone l20" aria-hidden="true"></span>
            2901****com
            <span class="glyphicon glyphicon-globe l20" aria-hidden="true"></span>
            中国 北京
            <span class="glyphicon glyphicon-time l20" aria-hidden="true"></span>
            2017-09-12 12:11:29
            </p>
            <p class="comment-content">服务器上同时运行php5.3和php7.2如何自由切换?</p>
    </div>
    <nav class="pagination-comments">
        <ul class="pagination pagination-sm">
            <li>
              <a href="#" aria-label="Previous">
                <span aria-hidden="true">«</span>
              </a>
            </li>
            <li class="active"><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li>
              <a href="#" aria-label="Next">
                <span aria-hidden="true">»</span>
              </a>
            </li>
          </ul>    
    </nav>
	-->

    
</div>
@endsection

@section('aside-content')

<div class="widget">
    <h4 class="title">最新博客</h4>
    <div class="content news">
		@foreach($news['list'] as $_new)
        <div class="row">
            <div class="col-md-8"><a href="{{$_new['uri']}}">{{mb_strimwidth($_new['title'], 0, 26, '..')}}</a></div>
            <div class="col-md-4"><span class="date">{{mb_strimwidth($_new['created_date'], 0, 10)}}</span></div>
        </div>
		@endforeach

    </div>
</div>

<div class="widget">
    <h4 class="title">分类</h4>
    <div class="content tag-cloud">
		<!--
		先放置category
		-->
		@foreach($category_list as $_item)
        <a href="/blog/category/{{$_item['id']}}">{{$_item['name']}}</a>
		@endforeach
        <a href="/blog/category">...</a>
    </div>
</div>


<div class="widget">
    <h4 class="title">标签云</h4>
    <div class="content tag-cloud">
		<!--
		先放置category
		-->
		@foreach($tags as $_item)
        <a href="javascript:void(0);/tag/{{$_item['id']}}" class="btn_tag" data-name="{{$_item['name']}}">{{$_item['name']}}</a>
		@endforeach
        <a href="/tag" class="btn_tag" data-name="更多">...</a>
    </div>
</div>
@endsection

@section('js')
@endsection
