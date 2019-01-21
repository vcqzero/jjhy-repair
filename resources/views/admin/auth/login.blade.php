@extends('admin.layout.layout-auth')
@section('title', '登录')
@section('content')
<div class="main-page" data-name="LoginPage" data-group="Auth">
<h3 class="form-title">用户登录</h3>
<form 
id="form-login"
class="login-form my-form-ajax-submit" 
action="/api/auth/login" 
method="post"
>
	@csrf
	<div class="alert alert-danger display-hide">
		<button class="close" data-close="alert"></button>
		<span> 请输入用户名和密码。 </span>
	</div>
	<div class="form-group">
		<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
		<label class="control-label visible-ie8 visible-ie9">用户名</label>
		<div class="input-icon">
			<i class="fa fa-user"></i> 
			<input
			class="form-control placeholder-no-fix" type="text"
			autocomplete="off" 
			placeholder="输入用户名" 
			name="username" 
			/>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label visible-ie8 visible-ie9">密码</label>
		<div class="input-icon">
			<i class="fa fa-lock"></i> <input
				class="form-control placeholder-no-fix" 
				type="password"
				autocomplete="off" 
				placeholder="请输入密码" 
				name="password" 
				/>
		</div>
	</div>
	<div class="form-actions">
		<label class="rememberme mt-checkbox mt-checkbox-outline"> <input
			type="checkbox" 
			name="remember" 
			value="true" 
			/> 记住我 <span></span>
		</label>
		<button type="submit" class="btn green pull-right disbabled" disabled="disabled">登录系统</button>
	</div>
	<div class="create-account">
	</div>
</form>
</div>
@endsection