@extends('weixin.layout.layout') @section('title', '报价成功')
@section('pageName', 'EditPage') @section('pageGroup', 'Offer')
@section('content')
<div class="weui-tab">
	<div class="weui-msg">
		<div class="weui-msg__icon-area">
			<i class="weui-icon-success weui-icon_msg"></i>
		</div>
		<div class="weui-msg__text-area">
			<h2 class="weui-msg__title">报价成功</h2>
			<p class="weui-msg__desc">
				请等待项目管理员审核，审核结果会发送至您的微信!
			</p>
		</div>
		<div class="weui-msg__opr-area">
			<p class="weui-btn-area">
				<a href="/weixin/worker/repair-order" class="weui-btn weui-btn_primary">查看报价</a> 
				<a href="/weixin" class="weui-btn weui-btn_default">继续报价</a>
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
