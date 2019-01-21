<div class="panel panel-info">
	<!-- Default panel contents -->
	<div class="panel-heading">
		<h3 class="panel-title">项目管理员</h3>
	</div>
	<!-- Table -->
	<table class="table">
		<tbody>
			<tr>
				<td class="td-width-10">状态</td>
				<td>
				<?php 
				$role = $user->roles_on_owning()->where('name', 'WORKYARD_ADMIN')->first();
				$status = $role->pivot->status;
				?>
				@if($status == 'WORKYARD_ADMIN_ENABLED')
				<span class="label label-success"> 正常 </span>
				@else
				<span class="label label-default"> 已禁用 </span>
				@endif
				</td>
			</tr>
			<tr>
				<td>共辖项目</td>
				<td>{{ count( $workyards = $user->workyards) }} （个）</td>
			</tr>
			@foreach($workyards as $workyard)
			<tr>
				<td># {{ $loop->index + 1 }}</td>
				<td>{{ $workyard->name }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
