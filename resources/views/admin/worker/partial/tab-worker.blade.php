<div class="portlet light portlet-fit portlet-datatable bordered">
	@include('admin/partial/protlet/title')

	<div class="portlet-body">
		<div class="table">
			<table class="table table-striped  table-hover table-checkable table-check"
				id="{{ $table_id }}">
				<thead>
					<tr class="head">
						<th data-field="id">ID</th>
						<th data-field="type">类型</th>
						<th data-field="realname">名称</th>
						<th data-field="tel">电话</th>
						<th data-field="address">所在地区</th>
						<th data-field="skill" style="max-width: 10%">技能</th>
						<th data-field="status">创建时间</th>
						<th data-field="status">状态</th>
						<th data-field="">操作</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>