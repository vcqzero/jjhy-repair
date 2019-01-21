<?php 
use Illuminate\Support\Facades\Auth;

$User = Auth::user();
$role = $User->role;

?>
<div class="weui-tabbar">
	
	<!-- 如果是游客 -->
	@if($role == 'GUEST' || empty($role))
	<a href="/weixin" class="weui-tabbar__item">
		<div class="weui-tabbar__icon">
			<span> <i class="fa fa-bars"></i></span>
		</div>
		<p class="weui-tabbar__label">设备维修</p>
	</a>
	@endif
	
	<!-- 如果是维修工程师 -->
	@if($role == 'WORKER')
	<a href="/weixin" class="weui-tabbar__item">
		<div class="weui-tabbar__icon">
			<span> <i class="fa fa-bars"></i></span>
		</div>
		<p class="weui-tabbar__label">设备维修</p>
	</a>
	<a href="/weixin/worker/repair-order" class="weui-tabbar__item">
		<div class="weui-tabbar__icon">
			<span> <i class="fa fa-wrench"></i></span>
		</div>
		<p class="weui-tabbar__label">我的维修</p>
	</a>
	@endif
	
	<!-- 如果是项目管理员 -->
	@if($role == 'WORKYARD_ADMIN')
	<a href="/weixin" class="weui-tabbar__item">
		<div class="weui-tabbar__icon">
			<span> <i class="fa fa-wrench"></i></span>
		</div>
		<p class="weui-tabbar__label">我的报修</p>
	</a> 
	<a href="/weixin/repair-order/add" class="weui-tabbar__item">
		<div class="weui-tabbar__icon">
			<span> <i class="fa fa-plus"></i></span>
		</div>
		<p class="weui-tabbar__label">新增报修</p>
	</a> 
	@endif
	
	<a href="/weixin/account" class="weui-tabbar__item">
		<div class="weui-tabbar__icon">
				<span> <i class="fa fa-user"></i></span>
		</div>
		<p class="weui-tabbar__label">我</p>
	</a>
</div>