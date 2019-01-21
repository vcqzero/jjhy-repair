@extends('weixin.layout.layout') @section('title', '评价成功')
@section('pageName', 'EditPage') @section('pageGroup', 'Offer')
@section('content')
<div class="weui-tab">
	<div class="weui-msg">
		<div class="weui-msg__icon-area">
			<i class="weui-icon-success weui-icon_msg"></i>
		</div>
		<div class="weui-msg__text-area">
			<h2 class="weui-msg__title">评价成功!</h2>
			<p class="weui-msg__desc">
			您的维修报单已完成。
			</p>
		</div>
		<div class="weui-msg__opr-area">
			<p class="weui-btn-area">
				<a href="/weixin" class="weui-btn weui-btn_primary">返回</a> 
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
