@extends('admin.layout.modal')

@section('modalSize', 'modal-sm')
@section('title', '设置为可抢单？')
@section('pageName', 'SetCanOfferPage')
@section('pageGroup', 'RepairOrder')

@section('modalBody')
<form id="form_set_can_offer" action="/api/repair-order/set-can-offer/{{ $repairOrder->id }}" method="post">
	<div class="form-group">
		<label class="control-label">订单编号：</label>
		<p class="form-control-static">{{ $repairOrder->order }}</p> 
	</div>
	<p class="text-danger">设置为可抢单之后，维修工程师可进行报价</p> 
	
	<div class="margin-top-10">
		<button type="submit" class="btn green" disabled="disabled"> 提交</button> 
	</div>
</form>
@endsection
