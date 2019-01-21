@extends('admin.layout.modal')

@section('title', '编辑')
@section('pageGroup', 'ItemType')
@section('pageName', 'EditPage')

@section('modalBody')
<form id="form-edit-item-type" action="/api/item-type/edit/{{ $ItemType->id }}" method="post">
	<div class="form-group">
		<label class="control-label">ID</label> 
		<input 
		type="text" 
		disabled="disabled"
		id="form-edit-id"
		value="{{ $ItemType->id }}"
		class="form-control"/>
	</div>
	<div class="form-group">
		<label class="control-label">名称<span class="required"> * </span></label> 
		<input 
		type="text" 
		name="name" 
		value="{{ $ItemType->name }}"
		class="form-control" 
		placeholder="请输入名称" />
	</div>
	<div class="form-group">
		<label class="control-label">介绍</label> 
		<input 
		type="text" 
		name="desc" 
		value="{{ $ItemType->desc }}"
		class="form-control"
		placeholder="选填：请输入介绍内容" />
	</div>
	<div class="margin-top-10">
		<button type="submit" class="btn green" disabled="disabled"> 提交保存 </button> 
	</div>
</form>
@endsection
