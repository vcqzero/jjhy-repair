@foreach ($offers as $offer)
<?php 
$repairOrder = $offer->repair_order
?>
<div 
	class="weui-form-preview paginator-cell"
	data-page-has-more-pages="{{ $offers->hasMorePages() ? 'yes' : 'no' }}"
	data-page-current-page="{{ $offers->currentPage() }}">
	<!-- status -->
	@include('weixin/repair-order/partial/preview-status', ['repairOrder'=> $repairOrder])
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
</div>
@endforeach

