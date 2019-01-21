@extends('weixin.layout.layout') @section('title', '接单成功')
@section('pageName', 'EditPage') @section('pageGroup', 'Offer')
@section('content')
<div class="weui-tab">
	<div class="weui-msg">
		<div class="weui-msg__icon-area">
			<i class="weui-icon-success weui-icon_msg"></i>
		</div>
		<div class="weui-msg__text-area">
			<h2 class="weui-msg__title">接单成功!</h2>
			<p class="weui-msg__desc">
				请联系项目，开始维修工作！
			</p>
		</div>
		<div class="weui-msg__opr-area">
			<p class="weui-btn-area">
				<a href="/weixin" class="weui-btn weui-btn_primary">继续接单</a> 
				<a href="/weixin/worker/repair-order" class="weui-btn weui-btn_default">查看接单</a>
			</p>
		</div>
		
<!-- 		<div class="weui-msg__extra-area"> -->
<!-- 			<div class="weui-footer"> -->
<!-- 				<p class="weui-footer__links"> -->
<!-- 				</p> -->
<!-- 				<p class="weui-footer__text">Copyright © 2008-2016 weui.io</p> -->
<!-- 			</div> -->
<!-- 		</div> -->
	</div>
</div>
@endsection
