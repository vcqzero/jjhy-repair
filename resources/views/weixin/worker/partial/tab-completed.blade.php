@foreach ($repairOrders as $repairOrder)
<div 
	class="weui-form-preview paginator-cell"
	data-page-has-more-pages="{{ $repairOrders->hasMorePages() ? 'yes' : 'no' }}"
	data-page-current-page="{{ $repairOrders->currentPage() }}"
	>
	<!-- status -->
	@include('weixin/repair-order/partial/preview-status', ['repairOrder'=> $repairOrder])
	<div class="weui-form-preview__bd">
		<!-- status -->
		@include('weixin/repair-order/partial/preview-order', ['repairOrder'
		=> $repairOrder])
		<!-- 项目 -->
		@include('weixin/repair-order/partial/preview-workyard-name',
		['repairOrder' => $repairOrder])
		<!-- 维修类型-->
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
		<!-- 接单时间 -->
		@include('weixin/repair-order/partial/preview-confirmed-at', ['repairOrder'=> $repairOrder])
		<!-- 完工时间 -->
		@include('weixin/repair-order/partial/preview-completed-at', ['repairOrder'=> $repairOrder])
		<!-- 维修评价 -->
		@include('weixin/repair-order/partial/preview-comment-star', ['repairOrder'=> $repairOrder])
	</div>
	<div class="weui-form-preview__ft">
	<!-- 联系项目 -->
	@include('weixin/repair-order/partial/preview-contact-workyard', ['repairOrder'=> $repairOrder])
	</div>
</div>
@endforeach

