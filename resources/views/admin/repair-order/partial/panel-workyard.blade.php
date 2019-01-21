<div class="panel panel-info">
	<!-- Default panel contents -->
	<div class="panel-heading">
		<h3 class="panel-title">项目信息</h3>
	</div>
	<!-- Table -->
	<table class="table modal-panel-table">
		<tbody>
			<tr>
				<td style="width: 10%">项目名称</td>
				<td>{{ $repairOrder->workyard->name }}</td>
			</tr>
			<tr>
				<td>所在地区</td>
				<td 
				class="show_address"
				data-codes="{{ $repairOrder->workyard->province . ',' . $repairOrder->workyard->city . ',' . $repairOrder->workyard->district }}">   </td>
			</tr>
			<tr>
				<td>具体地址</td>
				<td>{{ $repairOrder->workyard->address }}</td>
			</tr>
		</tbody>
	</table>
</div>
