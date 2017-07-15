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
		  <th>分类</th>
		  <th>发布时间</th>
		  <th>操作</th>
		</tr>
	  </thead>
	  <tbody>
		<tr>
		  <th scope="row">1</th>
		  <td>Mark</td>
		  <td>Otto</td>
		  <td>Otto</td>
			  <td>
				<a href=""><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>

				<a href=""><span class="glyphicon glyphicon-folder-close" aria-hidden="true"></span></a>
			</td>
		</tr>
		<tr>
		  <th scope="row">2</th>
		  <td>Jacob</td>
		  <td>Thornton</td>
		  <td>Thornton</td>
			  <td>
				<a href=""><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
				<a href=""><span class="glyphicon glyphicon-folder-close" aria-hidden="true"></span></a>

			</td>
		</tr>
		<tr>
		  <th scope="row">3</th>
		  <td>Larry</td>
		  <td>the Bird</td>
		  <td>the Bird</td>
		  <td>
				<a href=""><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
				<a href=""><span class="glyphicon glyphicon-folder-close" aria-hidden="true"></span></a>
			</td>
		</tr>
	  </tbody>
	</table>
</div>

                 
<nav class="pagination-wrap" role="navigation">
    <ul class="pagination">
        <li>
          <a href="#" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>
        <li class="active"><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">5</a></li>
        <li>
          <a href="#" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
      </ul>    
</nav>
@endsection
