@extends('weixin.layout.layout') @section('title', '个人中心')
@section('pageName', 'IndexPage') @section('pageGroup', 'Account')
@section('content')
<div class="weui-tab">
	<div class="weui-tab__bd padding-bottom">
		<div id="tab1" class="weui-tab__bd-item weui-tab__bd-item--active">
			<!-- avatar -->
			@include('weixin/account/partial/avatar')
			<!-- worker or workyard_admin -->
			<!-- 当用户已有选择角色时 -->
			@if($User->role != 'GUEST')
    			@if($User->role == 'WORKER')
    				<!-- 展示维修工程师信息 -->
    				@include('weixin/worker/partial/account-worker-info') 
    			@else
    			    <!-- 展示工地信息 -->
    				@include('weixin/account/partial/cells-workyard-admin') 
    			@endif
    			
    			<!-- change-role -->
    			@include('weixin/account/partial/cells-change-role')
			@else
			<!-- 当用户没有选择角色时 -->
			@include('weixin/account/partial/cells-create-role')
			@endif
			<br>
		</div>
	</div>
<!-- 	@include('weixin/partial/footer/footer') -->
	@include('weixin/partial/tarbar/main')
</div>
@endsection
