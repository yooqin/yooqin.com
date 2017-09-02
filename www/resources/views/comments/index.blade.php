@extends('layouts.yooqin')

@section('css')
<link href="{{ asset('static/editor.md-master/css/editormd.preview.min.css') }}" rel="stylesheet">
<link href="{{ asset('static/css/fix_md.css') }}" rel="stylesheet">
@endsection

@section('meta-title')给我留言 - 优勤网(www.yooqin.com)@endsection
@section('meta-description')留言@endsection
@section('meta-keywords')留言@endsection




@section('main-content')
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
        type:'website',
        document_id:1,
        btns:{reply:'.btn-click-post-comments'}
    });

    Comments.getList();
</script>
@endsection
