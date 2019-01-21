@extends('admin.layout.modal')

@section('title', '新增')
@section('pageGroup', 'RepairType')
@section('pageName', 'AddPage')

@section('modalBody')
<form id="form-add-item-type" action="/api/repair-type/add" method="post">
	<div class="form-group">
		<label class="control-label">名称<span class="required"> * </span></label> 
		<input type="text" name="name" class="form-control" placeholder="请输入名称" />
	</div>
	<div class="form-group">
		<label class="control-label">介绍</label> 
		<input type="text" name="desc" class="form-control"placeholder="选填：请输入介绍内容" />
	</div>
	<div class="margin-top-10">
		<button type="submit" class="btn green" disabled="disabled"> 提交保存 </button> 
	</div>
</form>
@endsection
