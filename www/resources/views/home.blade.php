@extends('layouts.yooqin')

@section('meta-title')优勤网互联网技术学习社区 - 优勤网(yooqin.com)@endsection
@section('meta-description')优勤网互联网技术学习社区,专注于互联网技术、产品、方向讨论研究及各类技术学习记录，主要方向为PHP,服务器等后端技术-优勤网(yooqin.com)@endsection
@section('meta-keywords')php,互联网,mysql,服务器,产品,优勤网,yooqin,技术,秦伟,滕州@endsection

@section('main-content')
@foreach($data['list'] as $_item)
<!-- begin article -->
<article id="1" class="post">
    <div class="post-head">
        <h1 class="post-title"><a href="{{$_item['blog_uri']}}">{{mb_strimwidth($_item['title'], 0, 36, '..')}}</a></h1>
        <div class="post-meta">
            <span class="author">作者: <a href="javascript:void(0);">{{$_item['user']['name']}}</a></span>
            <time class="post-date" datetime="20170909" title="20170909">{{$_item['created_date']}}</time>
        </div>
    </div>

    @if (isset($_item['pre_img']))
    <div class="featured-media">
        <a href="{{$_item['blog_uri']}}"><img src="{{$_item['pre_img']}}" alt="{{$_item['title']}}"/></a>
    </div>
    @endif
    <div class="post-content">
        <p>
		<?php
		echo mb_strimwidth(trim($_item['content']['md_content']), 0, 200, '...');
		?>
		</p>
    </div>
    <div class="post-permalink">
        <a href="{{$_item['blog_uri']}}" class="btn btn-default">阅读全文</a>
    </div>
    <footer class="post-footer clearfix">
        <div class="pull-left tag-list">
            <span class="glyphicon glyphicon-tags" aria-hidden="true"></span>
            @if (!empty($_item['tags']))
            @foreach ($_item['tags'] as $_tag)
            <a href="/tag/{{$_tag['id']}}">{{$_tag['name']}}</a>
            @endforeach
            @else
            <a href="javascript:void(0);">无</a>
            @endif
            <span class="glyphicon glyphicon-folder-open s20" aria-hidden="true"></span>
            <a href="/blog/category/{{$_item['category_id']}}">{{$_item['category_name']}}</a>
            <span class="glyphicon glyphicon-star s20 yellow" aria-hidden="true"></span>
            <a href="javascript:void(0);">{{$_item['views']}}</a>
        </div>
        <div class="pull-right share">
            <a href="" class="btn-click-share"><span class="glyphicon glyphicon-send" aria-hidden="true"></span></a>
        </div>
    </footer>
</article>
<!-- end article -->
@endforeach
@endsection

@section('aside-content')
<div class="widget">
    <h4 class="title">介绍</h4>
    <div class="content community">
        <div class="row">
            <div class="col-md-6"><a href="" class="btn btn-default btn-block btn-click-about">站点介绍</a></div>
            <div class="col-md-6"><a href="" class="btn btn-default btn-block btn-click-contact">联系我们</a></div>
        </div>
    </div>
</div>

<!--
<div class="widget">
    <h4 class="title">最新资讯</h4>
    <div class="content news">
        <div class="row">
            <div class="col-md-8"><a href="">老司机奥卡福吉林市解放路</a></div>
            <div class="col-md-4"><span class="date">2017-09-08</span></div>
        </div>
        <div class="row">
            <div class="col-md-8"><a href="">老司机奥卡福吉林市解放路</a></div>
            <div class="col-md-4"><span class="date">2017-09-08</span></div>
        </div>

    </div>
</div>
-->

<div class="widget">
    <h4 class="title">分类</h4>
    <div class="content tag-cloud">
		<!--
		先放置category
		-->
		@foreach($category_list as $_item)
        <a href="/category/{{$_item['id']}}">{{$_item['name']}}</a>
		@endforeach
        <a href="/category">...</a>
    </div>
</div>


<div class="widget">
    <h4 class="title">标签云</h4>
    <div class="content tag-cloud">
		<!--
		先放置category
		-->
		@foreach($tags as $_item)
        <a href="javascript:void(0);" class="btn_tag" data-name="{{$_item['name']}}">{{$_item['name']}}</a>
		@endforeach
        <a href="javascript:void(0)" class="btn_tag" data-name="更多">...</a>
    </div>
</div>
@endsection
