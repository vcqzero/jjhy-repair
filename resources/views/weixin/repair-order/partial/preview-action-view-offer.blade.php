<a
	class="weui-form-preview__btn weui-form-preview__btn_primary repair-order-offer"
	data-repair-order-id="{{ $repairOrder->id }}" href="javascript:">维修报价
	@if($count = count($repairOrder->offers)) 
	<span class="weui-badge"
	style="margin-left: 5px; margin-bottom: 5px;">{{ $count }}</span>
	@endif
</a>