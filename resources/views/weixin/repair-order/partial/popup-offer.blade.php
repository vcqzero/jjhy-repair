<div id="offer" class="weui-popup__container">
	<div class="weui-popup__overlay"></div>
	<div class="weui-popup__modal">
		<div class="toolbar">
			<div class="toolbar-inner">
				<a href="javascript:;" class="picker-button close-popup">关闭</a>
				<h1 class="title">维修报价</h1>
			</div>
		</div>
		<div style="margin-top: 50px">
			@if( count( $offers = $repairOrder->offers()->where('status', 'WAIT_CONFIRM')->get() ) )
				@foreach ( $offers as $offer )
        		<div class="weui-form-preview">
        			<div class="weui-form-preview__hd">
        				<label class="weui-form-preview__label">报价</label> 
        				<em
        				class="weui-form-preview__value"
        				>{{ $offer->price > 0 ? $offer->price : '-' }} <small>￥</small></em>
        			</div>
        			<div class="weui-form-preview__bd">
        				<div class="weui-form-preview__item">
        					<label class="weui-form-preview__label">工期</label> <span
        						class="weui-form-preview__value">{{ $offer->days }} <small>天</small></span>
        				</div>
        				<div class="weui-form-preview__item">
        					<label class="weui-form-preview__label">状态</label> <span
        						class="weui-form-preview__value">{{ $offer->offer_status->desc }}</span>
        				</div>
        				<div class="weui-form-preview__item">
        					<label class="weui-form-preview__label">维修工程师</label> <span
        						class="weui-form-preview__value">{{ $offer->user->realname }} </span>
        				</div>
        				<div class="weui-form-preview__item">
        					<label class="weui-form-preview__label">维修工程师电话</label> <span
        						class="weui-form-preview__value">{{ $offer->user->tel }} </span>
        				</div>
        				<div class="weui-form-preview__item">
        					<label class="weui-form-preview__label">维修单号</label> <span
        						class="weui-form-preview__value">{{ $repairOrder->order }} <small>天</small></span>
        				</div>
        			</div>
        			<div class="weui-form-preview__ft">
        				<a
            			class="weui-form-preview__btn weui-form-preview__btn_default preview-contact"
            			href="tel:{{ $offer->user->tel }}">联系维修工程师</a>
        				<button 
        				type="button"
        				data-offer-id="{{ $offer->id }}"
        				data-repair-order-id="{{ $repairOrder->id }}"
        				class="weui-form-preview__btn weui-form-preview__btn_primary offer-manager"
        				>操作</button>
        			</div>
        		</div>
    			@endforeach
    		@else
    		<!-- 未查到报价记录 -->
    		@include('weixin/partial/empty/empty', ['title' => '没有报价']) 
    		@endif
		</div>
	</div>
</div>