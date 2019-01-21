<div class="weui-form-preview__item">
	<label class="weui-form-preview__label">维修工程师</label> <span
		class="weui-form-preview__value">{{ $repairOrder->worker->realname }}</span>
</div>
<div class="weui-form-preview__item">
	<label class="weui-form-preview__label">联系电话</label> <span
		class="weui-form-preview__value">{{ $repairOrder->worker->tel }}</span>
</div>
@if( $repairOrder->offer_id > 0 )
<div class="weui-form-preview__item">
	<label class="weui-form-preview__label">报价</label> <span
		class="weui-form-preview__value">{{ $repairOrder->offer->price > 0 ? $repairOrder->offer->price : '-' }} ￥</span>
</div>

<div class="weui-form-preview__item">
	<label class="weui-form-preview__label">报价工期</label> <span
		class="weui-form-preview__value">{{ $repairOrder->offer->days }} 天</span>
</div>
@else
<div class="weui-form-preview__item">
	<label class="weui-form-preview__label">系统派单</label> <span
		class="weui-form-preview__value">管理员指定</span>
</div>
@endif