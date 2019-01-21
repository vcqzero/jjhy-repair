<div class="panel panel-primary">
	<!-- Default panel contents -->
	<div class="panel-heading">
		<h3 class="panel-title">维修工程师</h3>
	</div>
	<!-- Table -->
	<table class="table">
		<tbody>
			<!-- 显示维修工程师信息 -->
			<tr>
				<td style="width: 10%">维修工程师</td>
				<td>{{ $repairOrder->worker->realname }}</td>
			</tr>
			<tr>
				<td>联系方式</td>
				<td>{{ $repairOrder->worker->tel }}</td>
			</tr>
			<tr>
				<td>接单时间</td>
				<td>{{ $repairOrder->confirmed_at }}</td>
			</tr>
			@if( $repairOrder->completed_at )
			<tr>
				<td>维修完成</td>
				<td>{{ $repairOrder->completed_at }}</td>
			</tr>
			<tr>
				<td>评价</td>
				<td>{{ $repairOrder->comment_star ?? '-' }} 星</td>
			</tr>
			<tr>
				<td>评价内容</td>
				<td>{{ $repairOrder->comment_desc ?? '-' }}</td>
			</tr>
			@endif
		</tbody>
	</table>
</div>
