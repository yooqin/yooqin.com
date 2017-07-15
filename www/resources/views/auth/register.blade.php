@extends('layouts.admin')

@section('content')
<div class="list">
    <form class="form-horizontal login-module" method="post" action="/register">

		{{ csrf_field() }}
		<div class="row">
			<div class="col-sm-2"></div>
			<div class="col-sm-6">
			@if (count($errors) > 0)
				@foreach ($errors->all() as $error)
					<p class="text-danger">{{ $error }}</p>
				@endforeach
			@endif
			</div>
			<div class="col-sm-4"></div>
		</div>

        <div class="form-group">
            <label class="col-sm-2 control-label">头像</label>
            <div class="col-sm-6">
                <input type="input" class="form-control" name="head_avator" placeholder="头像URL" value="{{old('head_avator')}}" />
            </div>
            <div class="col-sm-4"></div>
        </div>


        <div class="form-group">
            <label class="col-sm-2 control-label">用户名</label>
            <div class="col-sm-6">
                <input type="input" class="form-control" name="name" placeholder="账号" value="{{old('name')}}" />
            </div>
            <div class="col-sm-4"></div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">邮箱</label>
            <div class="col-sm-6">
                <input type="input" class="form-control" name="email" placeholder="邮箱" value="{{old('email')}}" />
            </div>
            <div class="col-sm-4"></div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">密码</label>
            <div class="col-sm-6">
                <input type="password" class="form-control" name="password">
            </div>
            <div class="col-sm-4"></div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">重复密码</label>
            <div class="col-sm-6">
                <input type="password" class="form-control" name="password_confirmation">
            </div>
            <div class="col-sm-4"></div>
        </div>



        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">点击注册</button>
            </div>
        </div>
    </form>
</div>
@endsection
