@extends('admin.layout.modal')

@section('title', '确认删除?')
@section('pageGroup', 'RepairType')
@section('pageName', 'DeletePage')
@section('modalSize', 'modal-sm')

@section('modalBody')
<form id="form-delete-item-type" action="/api/repair-type/delete/{{ $ItemType->id }}" method="post">
	<div class="form-group">
		<label class="control-label">ID:</label>
		<p class="form-control-static">{{ $ItemType->id }}</p> 
	</div>
	<div class="margin-top-10">
		<button type="submit" class="btn green" disabled="disabled"> 提交</button> 
	</div>
</form>
@endsection
