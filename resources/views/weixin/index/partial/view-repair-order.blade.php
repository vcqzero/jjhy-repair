<?php 
use Illuminate\Support\Facades\Auth;

$user = Auth::user();
//查询是否已经进行过报价
$offers = $user->offers()->where(['repair_order_id' => $repairOrder->id, 'status'=> 'WAIT_CONFIRM'])->get();
?>
<div class="popup_container" style="margin-top: 50px">
	<div class="weui-form-preview">
		<!-- status -->
		@include('weixin/repair-order/partial/preview-status', ['repairOrder'
		=> $repairOrder])
		<div class="weui-form-preview__bd">
			<!-- status -->
			@include('weixin/repair-order/partial/preview-order', ['repairOrder'
			=> $repairOrder])
			<!-- 维修项目 -->
			@include('weixin/repair-order/partial/preview-repair-type',
			['repairOrder' => $repairOrder])
			<!-- 紧急程度 -->
			@include('weixin/repair-order/partial/preview-grade', ['repairOrder'
			=> $repairOrder])
			<!-- 故障描述 -->
			@include('weixin/repair-order/partial/preview-desc', ['repairOrder'
			=> $repairOrder])
			<!-- 所属项目 -->
			@include('weixin/repair-order/partial/preview-workyard-info', ['repairOrder'
			=> $repairOrder])
			<!-- 联系人 -->
			@include('weixin/repair-order/partial/preview-contact-user',
			['repairOrder' => $repairOrder])
			<!-- 联系电话 -->
			@include('weixin/repair-order/partial/preview-contact-tel',
			['repairOrder' => $repairOrder])
			<!-- 提交时间 -->
			@include('weixin/repair-order/partial/preview-created-at',
			['repairOrder' => $repairOrder])
		</div>
		<div class="weui-form-preview__ft">
			<a
			class="weui-form-preview__btn weui-form-preview__btn_default"
			href="tel:{{ $repairOrder->contact_tel }}">联系项目</a>
			<button
			class="weui-form-preview__btn weui-form-preview__btn_primary btn-do-offer"
			data-repair-order-id = "{{$repairOrder->id}}"
			>接单</button>
		</div>
	</div>
</div>