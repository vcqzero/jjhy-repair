<div class="portlet light portlet-fit portlet-datatable bordered">
	@include('admin/partial/protlet/title')
	<div class="portlet-body">
		<div class="table">
			<table class="table table-striped  table-hover table-checkable table-check"
				id="table_wait_pay">
				<thead>
					<tr class="head">
						<th data-field="order">订单编号</th>
						<th data-field="type">设备</th>
						<th data-field="grade">紧急程度</th>
						<th data-field="workyard">所属项目</th>
<!-- 						<th data-field="address">所在地区</th> -->
						<th data-field="created_at" style="width: 200px">创建时间</th>
						<th data-field="status">状态</th>
						<th data-field="">操作</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>