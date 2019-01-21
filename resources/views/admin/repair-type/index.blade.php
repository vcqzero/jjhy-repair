@extends('admin.layout.layout-table')

@section('title', '设备管理')
@section('pageName', 'IndexPage')
@section('pageGroup', 'RepairType')

@section('table-toolbar')
<div class="table-toolbar" id="my-toolbar">
	<div class="row">
		<div class="col-md-6 col-sm-6 col-xs-6">
			<div class="btn-group">
			<a href="/repair-type/add" class="btn blue sbold click-open-modal"><i class="fa fa-plus"></i> 新增</a>
			</div>
		</div>
	</div>
</div>
@endsection

@section('table')
<table
class="table table-striped  table-hover table-checkable"
data-editable-url="/my/editable/update/path"
id="item-types">
<thead>
	<tr class="head">
		<th data-field="id">ID</th>
		<th data-field="name" >名称</th>
		<th data-field="desc" >介绍</th>
		<th data-field="created_at">创建时间</th>
		<th data-field="updated_at">更新时间</th>
		<th data-field="">操作</th>
	</tr>
</thead>
</table>
@endsection
