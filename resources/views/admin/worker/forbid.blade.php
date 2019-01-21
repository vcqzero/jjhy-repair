<?php 
use App\Model\RoleStatus;

$role = $worker->roles_on_owning()->where('name', 'WORKER')->first();
$status = $role->pivot->status;
$forbid = $status == RoleStatus::WORKER_ENABLED;
?>

@extends('admin.layout.modal')

@section('modalSize', 'modal-sm')

@if($forbid)
@section('title', '确认禁用?')
@else
@section('title', '确认启用?')
@endif

@section('pageName', 'ForbidPage')
@section('pageGroup', 'Worker')

@section('modalBody')
<form id="form-forbide" action="/api/worker/forbid/{{ $worker->id }}" method="post">
	<div class="form-group">
		<label class="control-label">ID:</label>
		<p class="form-control-static">{{ $worker->id }}</p> 
	</div>
	@if($forbid)
	<p class="text-danger">禁用之后不可报价</p> 
	@endif
	<div class="margin-top-10">
		<button type="submit" class="btn green" disabled="disabled"> 提交</button> 
	</div>
</form>
@endsection
