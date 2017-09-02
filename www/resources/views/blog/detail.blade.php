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
            <time class="post-update-date" datetime="{{$data['updated_date']}}" title="{{$data['updated_date']}}">更新时间: {{$data['updated_date']}}</time>
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
    @include('comments.comments')
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
<script src="/static/js/xhr.js"></script>
<script src="/static/js/message.js"></script>
<script src="/static/js/comments.js"></script>
<script type="text/javascript">
    Comments.bindEvent({
        type:'blog',
        document_id:{{$data['id']}},
        btns:{reply:'.btn-click-post-comments'}
    });

    Comments.getList();
</script>
@endsection
