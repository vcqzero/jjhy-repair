<?php 
use App\Model\Workyard;

/* 获取7条需要审核的项目 */
$workyards = Workyard::query()->where('status', 'WAIT_CHECK')->take(7)->get();
?>
<div class="col-md-6 col-sm-6">
	<div class="portlet light bordered">
		<div class="portlet-title tabbable-line">
			<div class="caption">
				<i class=" icon-social-twitter font-dark hide"></i> <span
					class="caption-subject font-dark bold uppercase">项目审核</span>
			</div>
			<div class="actions">
                <div class="btn-group btn-group-devided">
                    <a 
                    class="btn green btn-outline btn-circle btn-sm active"
                    href="/workyard"
                    >更多内容</a>
                </div>
            </div>
		</div>
		<div class="portlet-body">
			<div class="mt-actions">
				@if(count($workyards))
    				@foreach($workyards as $workyard)
    				<div class="mt-action ">
    					<div class="mt-action-body my-home-mt-action">
    						
    						<div class="mt-action-row">
    							<div class="mt-action-info ">
    								<div class="mt-action-icon ">
    									<i class="fa fa-wrench"></i>
    								</div>
    								<div class="mt-action-details ">
    									<span class="mt-action-author">{{ $workyard->name }}</span>
    									<p class="mt-action-desc">描述：{{ str_limit($workyard->desc, 50, '...') }}</p>
    								</div>
    							</div>
    							<div class="mt-action-datetime ">
    								<span class="mt=action-time">提交时间：{{ $workyard->created_at }}</span>
    							</div>
    							<div class="mt-action-buttons ">
    								<div class="btn-group btn-group-circle">
    									<a 
    									href="/workyard/view/{{ $workyard->id }}"
    									class="btn green btn-sm btn-outline click-open-modal">详情</a>
    									<a 
    									href="/workyard/check/{{ $workyard->id }}"
    									class="btn blue btn-sm btn-outline click-open-modal">审核</a>
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
