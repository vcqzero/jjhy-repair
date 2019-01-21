<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">创建者信息</h3>
	</div>
	<!-- Table -->
	<table class="table">
		<tbody>
			<tr>
				<td style="width: 10%">ID</td>
				<td>{{ $repairOrder->user->id }}</td>
			</tr>
			<tr>
				<td>用户名</td>
				<td>{{ $repairOrder->user->username }}</td>
			</tr>
			
			<tr>
				<td>真实姓名</td>
				<td>{{ $repairOrder->user->realname }}</td>
			</tr>
			
			<tr>
				<td>手机号</td>
				<td>{{ $repairOrder->user->tel }}</td>
			</tr>
			
			<tr>
				<td>所在地区</td>
				<td 
				class="show_address"
				data-codes="{{ $repairOrder->user->province . ',' . $repairOrder->user->city . ',' . $repairOrder->user->district }}">   </td>
			</tr>
		</tbody>
	</table>
</div>
