@extends('admin.layout.modal')

@section('modalSize', 'modal-sm')

@if($forbid)
@section('title', '确认禁用?')
@else
@section('title', '确认启用?')
@endif

@section('pageName', 'ForbidPage')
@section('pageGroup', 'Workyard')

@section('modalBody')
<form id="form-forbide" action="/api/workyard/forbid/{{ $Workyard->id }}" method="post">
	<div class="form-group">
		<label class="control-label">ID:</label>
		<p class="form-control-static">{{ $Workyard->id }}</p> 
	</div>
	@if($forbid)
	<p class="text-danger">禁用之后不可发布维修等信息</p> 
	@endif
	<div class="margin-top-10">
		<button type="submit" class="btn green" disabled="disabled"> 提交</button> 
	</div>
</form>
@endsection
