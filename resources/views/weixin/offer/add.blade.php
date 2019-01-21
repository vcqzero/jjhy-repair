<?php 
use Illuminate\Support\Facades\Auth;

$user = Auth::user();
$role = $user->role;
$worker_role_status = '';
$worker_role = $user->roles_on_owning()->where('name', 'WORKER')->first();
if($worker_role) $worker_role_status = $worker_role->pivot->status;
//查询是否已经进行过报价
$offers = $user->offers()->where(['repair_order_id' => $repairOrder->id, 'status'=> 'WAIT_CONFIRM'])->get();
?>
@extends('weixin.layout.layout') @section('title', '新增报价')
@section('pageName', 'AddPage') @section('pageGroup', 'Offer')

@section('page-title')
@include('weixin/partial/navbar/back', [
	'withBack' => true,
	'title' => '新增报价'
])
@endsection('content')

@section('content')
<div class="weui-tab">
	<div class="weui-tab__bd">
		<div id="tab1" class="weui-tab__bd-item weui-tab__bd-item--active">
			@if($repairOrder->status !== 'WAIR_WORKER')
         		@include('weixin/partial/msg/msg', [
             		'type' => 'warn_primary',
             		'title'=> '不可报价',
             		'desc' => '订单无需报价',
             		'action' => [
             			'primary' =>['title'=> '返回', 'href'=> 'javascript:history.back()'],
             		],
             	]) 
         	<!-- 用户不是worker -->
         	@elseif($role !== 'WORKER')
         	<div class="weui-cells__title"></div>
         		@include('weixin/partial/msg/msg', [
             		'type' => 'warn_primary',
             		'title'=> '不可报价',
             		'desc' => '您的角色不是维修工程师，不能报价。',
             		'action' => [
             			'primary' =>['title'=> '返回', 'href'=> 'javascript:history.back()'],
             		],
             	]) 
            @elseif($worker_role_status == 'WORKER_WAIT_INIT')<!-- 判断当前用户角色  状态-->
                @include('weixin/partial/msg/msg', [
                	'type' => 'warn_primary',
                	'title'=> '不可报价',
                	'desc' => '请先成为维修工程师',
                	'action' => [
                		'primary' =>['title'=> '补充资料成为维修工程师', 'href'=> '/weixin/worker/add-info'],
                		'default' =>['title'=> '返回', 'href'=> 'javascript:history.back()'],
                	],
            	])
         	@elseif($worker_role_status !== 'WORKER_ENABLED')
         		@include('weixin/partial/msg/msg', [
             		'type' => 'warn',
             		'title'=> '不可报价',
             		'desc' => '您的账户已被禁用，不可报价。',
             		'action' => [
             			'primary' =>['title'=> '返回', 'href'=> 'javascript:history.back()'],
             		],
             	]) 
             	
         	@elseif( count($offers) )
             	<!-- 如果已经进行过报价则不能再次报价 -->
             	@include('weixin/partial/msg/msg', [
             		'type' => 'waiting',
             		'title'=> '已提交过报价',
             		'desc' => '等待项目管理员确认报价',
             		'action' => [
             			'primary' =>['title'=> '返回', 'href'=> 'javascript:history.back()'],
             		],
             	]) 
         	@else
    		<form id="offer-add" action="/api/offer/add" method="post" >
        		<div class="weui-cells weui-cells_form">
        			<!-- 报价 -->
        			@include('weixin/partial/input/static', [
        			'label'=>'维修单号',
        			'value'=>$repairOrder->order,
        			])
        			@if($can_offer_price)
        			<!-- 是否可填写价格 -->
            			@include('weixin/partial/input/input', [
            			'label'=>'报价（￥）',
            			'require' => true,
            			'name'=>'price',
            			'placeholder'=>'请填写报价',
            			])
            		@endif
        			<!-- 预计工期 -->
        			@include('weixin/partial/input/input', [
        			'label'=>'工期（天）',
        			'require' => true,
        			'name'=>'days',
        			'placeholder'=>'请输入预期工期',
        			])
        			<input type="hidden" value="{{ $repairOrder->id }}" name="repair_order_id">
        		</div>
        		@include('weixin/partial/button/submit', ['title'=>'提交报价'])
        	</form>
        	@endif
		</div>
	</div>
</div>
@endsection