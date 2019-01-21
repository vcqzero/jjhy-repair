@extends('admin.layout.modal')

@section('modalSize', 'modal-sm')
@section('title', '确认关闭订单？')
@section('pageName', 'ClosePage')
@section('pageGroup', 'RepairOrder')

@section('modalBody')
<form id="form_close" action="/api/repair-order/close/{{ $repairOrder->id }}" method="post">
	<div class="form-group">
		<label class="control-label">订单编号：</label>
		<p class="form-control-static">{{ $repairOrder->order }}</p> 
	</div>
	<p class="text-danger">如订单无异常，请不要擅自关闭订单</p> 
	
	<div class="margin-top-10">
		<button type="submit" class="btn green" disabled="disabled"> 提交</button> 
	</div>
</form>
@endsection
