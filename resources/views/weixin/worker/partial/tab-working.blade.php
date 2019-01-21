@foreach ($repairOrders as $repairOrder)
<div class="weui-form-preview preview-on-working">
	<!-- status -->
	@include('weixin/repair-order/partial/preview-status', ['repairOrder'
		=> $repairOrder])
	<div class="weui-form-preview__bd">
		<!-- order -->
		@include('weixin/repair-order/partial/preview-order', ['repairOrder'
		=> $repairOrder])
		<!-- 项目 -->
		@include('weixin/repair-order/partial/preview-workyard-name',
		['repairOrder' => $repairOrder])
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
		<!-- 故障描述 -->
		@include('weixin/repair-order/partial/preview-desc', ['repairOrder' =>
		$repairOrder])
		<!-- 接单时间 -->
		@include('weixin/repair-order/partial/preview-confirmed-at', ['repairOrder'=> $repairOrder])
	</div>
	<div class="weui-form-preview__ft">
        <!-- 联系项目 -->
		@include('weixin/repair-order/partial/preview-contact-workyard', ['repairOrder'=> $repairOrder])
    </div>
</div>
@endforeach

