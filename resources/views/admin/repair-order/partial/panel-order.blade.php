<div class="panel panel-info">
	<!-- Default panel contents -->
	<div class="panel-heading">
		<h3 class="panel-title">报修信息</h3>
	</div>
	<!-- Table -->
	<table class="table">
		<tbody>
			<tr>
				<td>订单编号</td>
				<td>{{ $repairOrder->order }}</td>
			</tr>
			<tr>
				<td>设备</td>
				<td>{{ $repairOrder->repair_type->name }}</td>
			</tr>
			
			<tr>
				<td>紧急程度</td>
				<td>{{ $repairOrder->repair_order_grade->desc }}</td>
			</tr>
			
			<tr>
				<td style="min-width: 10%">故障描述</td>
				<td>{{ $repairOrder->desc }}</td>
			</tr>
			
			<tr>
				<td>联系人</td>
				<td>{{ $repairOrder->contact_user }}</td>
			</tr>
			
			<tr>
				<td>联系方式</td>
				<td>{{ $repairOrder->contact_tel }}</td>
			</tr>
			
			<tr>
				<td>状态</td>
				<td>
				<?php 
				$status = $repairOrder->repair_order_status;
				$status_name = $status->name;
				$status_desc = $status->desc;
				switch($status_name) {
				    case 'WAIT_DISTRIBUTE':
				    case 'WAIR_WORKER':
                        $status_dom = '<span class="label label-primary">' . $status_desc .'</span>';
                        break;
				    case 'WORKING':
				        $status_dom = '<span class="label label-info">' . $status_desc .'</span>';
				        break;
				    case 'COMPLETED':
				        $status_dom = '<span class="label label-success">' . $status_desc .'</span>';
				        break;
				    case 'CLOSED':
				        $status_dom = '<span class="label label-default">' . $status_desc .'</span>';
			            break;
				}
				echo $status_dom;
				?>
				</td>
			</tr>
			<tr>
				<td>创建时间</td>
				<td>{{ $repairOrder->created_at }}</td>
			</tr>
			
			@if( $repairOrder->status == 'CLOSED' )
			<tr>
				<td>订单关闭</td>
				<td>{{ $repairOrder->updated_at }}</td>
			</tr>
			@endif
		</tbody>
	</table>
</div>
