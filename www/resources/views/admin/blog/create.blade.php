@extends('layouts.admin')


@section('nav-content')
<!-- end navigation -->
<div class="container">
    <nav class="category" role="navigation">
        <ul class="menu">
            <li class="presentation" role="presentation"><a href="/adm/blog">博客列表</a></li>
            <li class="nav-current"><a href="/adm/blog/create">创建博客</a></li>
        </ul>
    </nav>
</div>
@endsection


@section('content')
<div class="list">
    <form class="form-horizontal">

        <div class="form-group">
            <label class="col-sm-2 control-label">博客属性</label>
            <div class="col-sm-4">
                <select class="form-control" name="category_id">
                    <option>互联网</option>
                    <option>服务器</option>
                    <option>编程技术</option>
                </select>
            </div>
            <div class="col-sm-1">
                <a href="" class="editcategory btn-edit-category"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span></a> 
            </div>

            <div class="col-sm-2">
                <select class="form-control" name="source">
                    <option>源创</option>
                    <option>转载</option>
                </select>
            </div>

            <div class="col-sm-2">
                <select class="form-control" name="blog_type">
                    <option>Markdown博客</option>
                    <option>相册游记</option>
                </select>
            </div>

          </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">标题</label>
            <div class="col-sm-8">
                <input type="input" class="form-control" name="title" placeholder="title">
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-sm-2 control-label">描述</label>
            <div class="col-sm-8">
                  <input type="input" class="form-control" name="description" placeholder="descript">
            </div>
          </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">关键词</label>
            <div class="col-sm-5">
                <input type="input" class="form-control" name="keywords" placeholder="keywords">
            </div>
            <div class="col-sm-5 input-tips"><p class="text-warning">* 请使用,分割关键词会自动转换为标签</p></div>
        </div>


        <div class="form-group">
            <label class="col-sm-2 control-label">自定义URI</label>
            <div class="col-sm-5">
                  <input type="input" class="form-control" name="uri" placeholder="uri">
            </div>
      	</div>

        <div class="form-group">
            <div class="col-sm-12">
                <div id="editormd">
                    <textarea style="display:none;"></textarea>
                </div>
            </div>
          </div>


        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">点击发布</button>
            </div>
        </div>
    </form> 
</div>
@endsection

@section('css')
@endsection
<link href="/static/editor.md-master/css/editormd.css" rel="stylesheet">
@section('js')
<script src="/static/editor.md-master/editormd.min.js"></script>
<script type="text/javascript">
var Editor;
$(function() {
    Editor = editormd({
		id:"editormd",
        width   : "90%",
        height  : 640,
        syncScrolling : "single",
        path    : "/static/editor.md-master/lib/"
    });
});
</script>
@endsection
