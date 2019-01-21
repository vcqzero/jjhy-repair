<?php
use Illuminate\Support\Facades\Auth;

$user = Auth::user();
$Workyard = $user->workyard;
?>
@extends('weixin.layout.layout') @section('title', '项目报修')
@section('pageName', 'IndexPage') @section('pageGroup', 'RepairOrder')
@section('content')
<div class="weui-tab">
	<div class="weui-navbar">
		<a class="weui-navbar__item weui-bar__item--on badge-count-wait-worker" href="#repair_order_list_wait_worker">派单中</a>
		<a class="weui-navbar__item badge-count-working" href="#repair_order_list_working"> 维修中</a>
		<a class="weui-navbar__item" href="#repair_order_list_completed"> 已完成 </a>
		<a class="weui-navbar__item" href="#repair_order_list_closed"> 已关闭 </a>
	</div>

	<div class="weui-tab__bd padding-bottom">
		<div id="repair_order_list_wait_worker" class="weui-tab__bd-item weui-tab__bd-item--active show-empty">
			<!-- 判断当前用户是否拥有项目 -->
			@if(count($Workyard))
    			<!-- 当前报修记录 -->
    			@include('weixin/repair-order/partial/tab-wait-worker', ['Workyard'=>$Workyard])
			@else
				<!-- 如果还未创建项目，显示创建项目按钮 -->
				@include('weixin/partial/empty/empty', ['title' => '还未创建项目'])
    			<div class="weui-btn-area" style="">
    				<a href="/weixin/workyard/add" class="weui-btn weui-btn_primary">创建项目</a>
    			</div>
			@endif
		</div>
		
		<!-- 正在维修中 -->
		<div id="repair_order_list_working" class="weui-tab__bd-item show-empty">
			@if(count($Workyard) && count($repairOrders = $Workyard->repairOrders()->where('status', 'WORKING')->latest()->get()))
    			<div class="hidden count-working">{{ count($repairOrders) }}</div>
    			@include('weixin/repair-order/partial/tab-working', ['Workyard'=>$Workyard])
    		@endif
		</div>
		
		<!-- 已完成的维修单 -->
		<div id="repair_order_list_completed" class="weui-tab__bd-item show-empty">
			@if(count($Workyard) && count($repairOrders = $Workyard->repairOrders()->where('status', 'COMPLETED')->latest()->simplePaginate(3)))
				<div class="repair_order_list_completed_container">
				@include('weixin/repair-order/partial/tab-completed', ['repairOrders'=>$repairOrders])
				</div>
            @endif
		</div>
		
		<!-- 已关闭的维修单 -->
		<div id="repair_order_list_closed" class="weui-tab__bd-item show-empty">
			@if(count($Workyard) && count($repairOrders = $Workyard->repairOrders()->where('status', 'CLOSED')->latest()->simplePaginate(3)))
				<div class="repair_order_list_closed_container">
				@include('weixin/repair-order/partial/tab-closed', ['repairOrders'=>$repairOrders])
            	</div>
            @endif
		</div>

	</div>

	@include('weixin/partial/tarbar/main')
</div>
@endsection
