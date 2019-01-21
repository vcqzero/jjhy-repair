<div class="portlet light portlet-fit portlet-datatable bordered">
	@include('admin/partial/protlet/title')
	<div class="portlet-body">
		<div class="table">
			<table class="table table-striped  table-hover table-checkable table-check"
				id="table_completed">
				<thead>
					<tr class="head">
						<th data-field="order">订单编号</th>
						<th data-field="workyard">所属项目</th>
						<th data-field="type">设备</th>
						<th data-field="desc">故障描述</th>
						<th data-field="worker">维修工程师</th>
						<th data-field="confirmed_at">接单时间</th>
						<th data-field="completed_at">完工时间</th>
						<th data-field="comment_star">评价</th>
						<th data-field="status">状态</th>
						<th data-field="">操作</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>