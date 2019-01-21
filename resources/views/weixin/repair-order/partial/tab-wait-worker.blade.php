@if(count($repairOrders = $Workyard->repairOrders()->whereIN('status',['WAIR_WORKER', 'WAIT_DISTRIBUTE'])->get()))
<div class="hidden count-wait-worker">{{ count($repairOrders) }}</div>
@foreach ($repairOrders as $repairOrder)
<div class="repair-order-container ">
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
    		@include('weixin/repair-order/partial/preview-desc', ['repairOrder' =>
    		$repairOrder])
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
			@include('weixin/repair-order/partial/preview-desc', ['repairOrder'
			=> $repairOrder])
		</div>
		
		<div class="weui-form-preview__ft">
			<a
				class="weui-form-preview__btn weui-form-preview__btn_priamry repair-order-manager"
				data-repair-order-id="{{ $repairOrder->id }}" href="javascript:">管理</a>
		</div>
	</div>
	<!-- offer -->
	@include('weixin/repair-order/partial/popup-offer', ['repairOrder' => $repairOrder])
</div>
@endforeach
 
@else
@include('weixin/partial/empty/empty', ['title' => '没有记录']) 
@endif

