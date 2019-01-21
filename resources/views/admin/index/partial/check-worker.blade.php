<?php 
use App\Model\User;

/* 获取7条需要审核的项目 */
$workers = User::query()->whereHas('roles_on_owning', function($query) {
    $query->where('name', 'WORKER')->where('role_user.status', 'WORKER_WAIT_CHECK');
})->take(7)->get();
?>
<div class="col-md-6 col-sm-6">
	<div class="portlet light bordered">
		<div class="portlet-title tabbable-line">
			<div class="caption">
				<i class=" icon-social-twitter font-dark hide"></i> <span
					class="caption-subject font-dark bold uppercase">维修工程师审核</span>
			</div>
			<div class="actions">
                <div class="btn-group btn-group-devided">
                    <a 
                    class="btn green btn-outline btn-circle btn-sm active"
                    href="/worker"
                    >更多内容</a>
                </div>
            </div>
		</div>
		<div class="portlet-body">
			<div class="mt-actions">
				@if(count($workers))
    				@foreach($workers as $worker)
    				<div class="mt-action ">
    					<div class="mt-action-body my-home-mt-action">
    						
    						<div class="mt-action-row">
    							<div class="mt-action-info ">
    								<div class="mt-action-icon ">
    									<i class="fa fa-user"></i>
    								</div>
    								<div class="mt-action-details ">
    									<span class="mt-action-author">{{ $worker->realname }}</span>
    									<p class="mt-action-desc">手机号：{{ $worker->tel }}</p>
    								</div>
    							</div>
    							<div class="mt-action-datetime ">
    								<span class="mt=action-time">提交时间：{{ $worker->created_at }}</span>
    							</div>
    							<div class="mt-action-buttons ">
    								<div class="btn-group btn-group-circle">
    									<a 
    									href="/worker/check/{{ $worker->id }}"
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
