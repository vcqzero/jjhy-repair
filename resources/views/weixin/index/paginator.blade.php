@if(count($orders)) 
@foreach($orders as $order)
<?php 
$workyard = $order->workyard;;
?>
<div class="weui-panel weui-panel_access paginator-cell"
data-page-has-more-pages="{{ $orders->hasMorePages() ? 'yes' : 'no' }}"
data-page-current-page="{{ $orders->currentPage() }}"
>
	<div class="weui-panel__hd">
    	<span class="margin-right-5">
    	<i class="fa fa-road"></i>
    	</span>{{ $workyard->name }}
	</div>
	<div class="weui-panel__bd">
    	<a href="javascript:void(0);" 
    	data-order-id="{{ $order->id }}"
    	class="weui-media-box weui-media-box_appmsg view-repair-order">
            <div class="weui-media-box__hd">
            	<img class="weui-media-box__thumb" src="/_weixin/images/order-list-wrench.png">
            </div>
            <div class="weui-media-box__bd">
                <h4 class="weui-media-box__title">{{ $order->repair_type->name }}</h4>
                <p class="weui-media-box__desc">{{ $order->desc }}</p>
                <ul class="weui-media-box__info">
    				<li class="weui-media-box__info__meta address_area"
    				data-codes = "{{ $workyard->province . ',' . $workyard->city . ',' . $workyard->district }}"
    				>
    				<span class="margin-right-5"><i class="fa fa-map-marker"></i></span>
    				<span class="address_area_name"></span>
    				</li>
    			</ul>
            </div>
        </a>
	</div>
	<div class="weui-panel__ft">
        <a 
        href="#" 
        class="weui-cell weui-cell_access weui-cell_link btn-do-offer"
        data-repair-order-id = "{{$order->id}}"
        >
          <div class="weui-cell__bd">
          <span class="margin-right-5"><i class="fa fa-share"></i></span>
          	接单
          </div>
          <span class="weui-cell__ft"></span>
        </a>    
  </div>
</div>
@endforeach 
@endif
