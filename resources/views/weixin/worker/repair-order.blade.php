<?php
use Illuminate\Support\Facades\Auth;

$user = Auth::user();
$status = 'WORKER_WAIT_INIT';
$role = $user->roles_on_owning()
->where('name', $user->role)->first();
if($role) {
    $status = $role->pivot->status;
}
?>
@extends('weixin.layout.layout') @section('title', '我的维修')
@section('pageName', 'RepairOrderPage') @section('pageGroup', 'Worker')
@section('content')
<div class="weui-tab">
	<div class="weui-navbar">
		
		<a class="weui-navbar__item badge-count-working weui-bar__item--on" 
		href="#repair_order_list_working"> 维修中</a>
		
		<a class="weui-navbar__item" 
		href="#repair_order_list_completed"> 维修完成 </a>
		
		
	</div>

	<div class="weui-tab__bd padding-bottom">
	    <!-- 正在报价中 -->
		<div id="repair_order_list_offering" class="weui-tab__bd-item  show-empty">
			@if( count( $offers = $user->offers()->where('status', 'WAIT_CONFIRM')->get() ) )
    			@include('weixin/worker/partial/tab-offering', ['offers' => $offers])
			@endif
			<!-- 未成为维修工程师进行提示 -->
			@if($status == 'WORKER_WAIT_INIT')
				@include('weixin/partial/empty/empty', ['title' => '请先成为维修工程师'])
    			<div class="weui-btn-area" style="">
    				<a href="/weixin/worker/add-info" class="weui-btn weui-btn_primary">补充资料成为维修工程师</a>
    			</div>
			@endif
		</div>
		
		<!-- 正在维修中 -->
		<div id="repair_order_list_working" class="weui-tab__bd-item show-empty weui-tab__bd-item--active">
			@if( count( $repairOrders = $user->repairOrders()->where('status', 'WORKING')->latest()->get() ) )
    			@include('weixin/worker/partial/tab-working', ['repairOrders' => $repairOrders])
			@endif
		</div>
		
		<!-- 已完成的维修单 -->
		<div id="repair_order_list_completed" class="weui-tab__bd-item show-empty">
			
			@if( count( $repairOrders = $user->repairOrders()->where('status', 'COMPLETED')->latest()->simplePaginate(3) ) )
				<div class="repair_order_list_completed_container">
    			@include('weixin/worker/partial/tab-completed', ['repairOrders' => $repairOrders])
    			</div>
			@endif
		</div>
		
		<!-- 报价失败订单 -->
		<div id="repair_order_list_failed" class="weui-tab__bd-item show-empty">
			@if( count( $offers = $user->offers()->whereIn('status', ['FAILED', 'REFUSEED'])->simplePaginate(3) ) )
				<div class="repair_order_list_failed_container">
				@include('weixin/worker/partial/tab-failed', ['offers' => $offers])
				</div>
			@endif
		</div>
	</div>
	@include('weixin/partial/tarbar/main')
</div>
@endsection
