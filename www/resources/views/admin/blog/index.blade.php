@extends('layouts.admin')


@section('nav-content')
<!-- end navigation -->
<div class="container">
    <nav class="category" role="navigation">
        <ul class="menu">
            <li class="nav-current" role="presentation"><a href="/adm/blog">博客列表</a></li>
            <li class="presentation"><a href="/adm/blog/create">创建博客</a></li>
        </ul>
    </nav>
</div>
@endsection


@section('content')
<div class="list">
	<table class="table table-hover">
	  <thead>
		<tr>
		  <th>#</th>
		  <th>标题</th>
		  <th>类型</th>
		  <th>方式</th>
		  <th>浏览数</th>
		  <th>发布时间</th>
		  <th>操作</th>
		</tr>
	  </thead>
	  <tbody>
        @foreach($list['list'] as $_item)
		<tr>
		  <th scope="row">{{$_item['id']}}</th>
		  <td>{{$_item['title']}}</td>
		  <td>{{$_item['type_name']}}</td>
		  <td>{{$_item['source_name']}}</td>
		  <td>{{$_item['views']}}</td>
		  <td>{{$_item['created_date']}}</td>
		    <td>
                <a href="javascript:void(0);" class="btn_edit" data-id="{{$_item['id']}}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>

				&nbsp;&nbsp;<a href="javascript:void(0);" class="btn_delete" data-id="{{$_item['id']}}"><span class="glyphicon glyphicon-folder-close" aria-hidden="true"></span></a>
			</td>
		</tr>
        @endforeach
	  </tbody>
	</table>
</div>

                 
<nav class="pagination-wrap" role="navigation">
    {{$list['paginate']['links']}}    
</nav>
@endsection

@section('js')
<script src="/static/js/xhr.js"></script>
<script src="/static/js/message.js"></script>
<script src="/static/js/api.js"></script>
<script src="/static/js/blog.js"></script>
<script type="text/javascript">
	blog.bindEvent();
</script>
@endsection
