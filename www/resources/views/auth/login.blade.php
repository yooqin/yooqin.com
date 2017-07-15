@extends('layouts.admin')

@section('content')
<div class="list">
    <form method="POST" action="/login" class="form-horizontal login-module">

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
            <label class="col-sm-2 control-label">账号</label>
            <div class="col-sm-6">
                <input type="input" class="form-control" name="email" placeholder="账号" value="{{old('email')}}">
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
            <label class="col-sm-2 control-label">记住登录</label>
            <div class="col-sm-6">
                <input type="checkbox" name="remember">
            </div>
            <div class="col-sm-4"></div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">点击登录</button>
            </div>
        </div>
    </form>
</div>
@endsection
