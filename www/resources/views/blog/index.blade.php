@extends('layouts.yooqin')

@section('meta-title'){{$current_category['title']}} - 优勤网互联网技术学习社区(www.yooqin.com)@endsection
@section('meta-description'){{$current_category['description']}} - 优勤网(www.yooqin.com)@endsection
@section('meta-keywords'){{$current_category['keywords']}}@endsection

@section('main-content')
<nav class="category" role="navigation">
    <ul class="menu">
        <li class="
        @if (isset($current_category_id)) 
            presentation
        @else
            nav-current
        @endif
        " role="presentation"><a href="/">全部博客</a></li>
        @foreach($category_list as $_category)
        <li class="
        @if (isset($current_category_id) && $current_category_id == $_category['id']) 
            nav-current
        @else
            presentation
        @endif
        "><a href="/blog/category/{{$_category['id']}}">{{$_category['name']}}</a></li>
        @endforeach
    </ul>
</nav>

@if (isset($data['list']))
@foreach($data['list'] as $_item)
<!-- begin article -->
<article id="article_{{$_item['id']}}" class="post">
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
@else
<article class="post">
* 分类下暂无数据
</article>
@endif


<nav class="pagination-wrap" role="navigation">
    {{$data['paginate']['links']}}
</nav>

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
