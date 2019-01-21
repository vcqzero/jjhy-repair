<div class="panel panel-info">
	<!-- Default panel contents -->
	<div class="panel-heading">
		<h3 class="panel-title">维修技能</h3>
	</div>
	<!-- Table -->
	<table class="table">
		<tbody>
			<tr>
				<td class="td-width-10">状态</td>
				<td>
				<?php 
				$role = $worker->roles_on_owning()->where('name', 'WORKER')->first();
				$status = $role->pivot->status;
				?>
				@if($status == 'WORKER_ENABLED')
				<span class="label label-success"> 正常 </span>
				@elseif($status == 'WORKER_FORBIDDEN')
				<span class="label label-default"> 已禁用 </span>
				@elseif($status == 'WORKER_WAIT_CHECK')
				<span class="label label-warning"> 等待审核 </span>
				@else
				<span class="label label-danger"> 审核未通过 </span>
				@endif
				</td>
			</tr>
			<tr>
				<td>维修技能</td>
				<td>{{ $worker->skill->skill }}</td>
			</tr>
		</tbody>
	</table>
</div>
