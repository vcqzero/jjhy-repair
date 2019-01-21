<div class="hidden count-offering">{{ count($offers) }}</div>
@foreach ($offers as $offer)
<?php 
$repairOrder = $offer->repair_order;
?>
<div class="weui-form-preview">
	<!-- status -->
	@include('weixin/offer/partial/preview-status', ['offer'=> $offer])
	<div class="weui-form-preview__bd">
		<!-- order -->
		@include('weixin/repair-order/partial/preview-order', ['repairOrder'
		=> $repairOrder])
		<!-- 维修项目 -->
		@include('weixin/repair-order/partial/preview-repair-type',
		['repairOrder' => $repairOrder])
		<!-- 紧急程度 -->
		@include('weixin/repair-order/partial/preview-grade', ['repairOrder'
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
		<!-- 故障描述 -->
		@include('weixin/repair-order/partial/preview-desc', ['repairOrder' =>
		$repairOrder])
		<!-- 我的报价 -->
		@include('weixin/offer/partial/preview-my-offer', ['offer'=> $offer])
	</div>
	<div class="weui-form-preview__ft">
		<a
			class="weui-form-preview__btn weui-form-preview__btn_primary offer-manager"
			data-offer-id="{{ $offer->id }}" href="javascript:">报价管理</a>
	</div>
</div>
@endforeach

