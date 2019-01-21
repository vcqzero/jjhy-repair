<?php 
use App\Model\RepairOrder;

/* 获取9条需要指定维修工程师的订单 */
$repair_orders = RepairOrder::query()
->where('status', 'WAIT_DISTRIBUTE')
->with('repair_type')
->with('workyard')
->take(7)->get();
?>
<div class="col-md-6 col-sm-6">
	<div class="portlet light bordered">
		<div class="portlet-title tabbable-line">
			<div class="caption">
				<i class=" icon-social-twitter font-dark hide"></i> <span
					class="caption-subject font-dark bold uppercase">派单</span>
			</div>
			<div class="actions">
                <div class="btn-group btn-group-devided">
                    <a 
                    class="btn green btn-outline btn-circle btn-sm active"
                    href="/repair-order"
                    >更多内容</a>
                </div>
            </div>
		</div>
		<div class="portlet-body">
			<div class="mt-actions">
				@if(count($repair_orders))
    				@foreach($repair_orders as $repair_order)
    				<div class="mt-action ">
    					<div class="mt-action-body my-home-mt-action">
    						
    						<div class="mt-action-row">
    							<div class="mt-action-info ">
    								<div class="mt-action-icon ">
    									<i class="fa fa-wrench"></i>
    								</div>
    								<div class="mt-action-details ">
    									<span class="mt-action-author">{{ $repair_order->repair_type->name }}</span>
    									<p class="mt-action-desc">故障描述：{{ str_limit($repair_order->desc, 50, '...') }}</p>
<!--     									<p class="mt-action-desc"> -->
<!--     									提交时间：{{ $repair_order->created_at }} -->
<!--     									</p> -->
    								</div>
    							</div>
    							<div class="mt-action-datetime ">
    								<span class="mt=action-time">项目：{{ $repair_order->workyard->name }}</span>
    							</div>
    							<div class="mt-action-buttons ">
    								<div class="btn-group btn-group-circle">
    									<a 
    									href="/repair-order/view/{{ $repair_order->id }}"
    									class="btn green btn-sm btn-outline click-open-modal">详情</a>
    									<a 
    									href="/repair-order/distribute/{{ $repair_order->id }}"
    									class="btn blue btn-sm btn-outline click-open-modal">派单</a>
    								</div>
    							</div>
    						</div>
    						
    					</div>
    				</div>
    				@endforeach
    			@else
    				@include('admin/index/partial/empty')
    			@endif
			</div>
		</div>
	</div>
</div>
