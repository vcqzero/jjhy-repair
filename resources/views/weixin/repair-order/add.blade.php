<?php 
use Illuminate\Support\Facades\Auth;

$user = Auth::user();
$Workyard = $user->workyard;

//用户角色
$role = $user->role;
$worker_role = $user->roles_on_owning()->where('name', 'WORKYARD_ADMIN')->first();
$worker_role_status = $worker_role->pivot->status;
?>

@extends('weixin.layout.layout') @section('title', '项目报修')
@section('pageName', 'AddPage') @section('pageGroup', 'RepairOrder')

@section('page-title')
@include('weixin/partial/navbar/back', [
	'withBack' => true,
	'title' => '新增项目报修'
])
@endsection('content')

@section('content')
<div class="weui-tab">
	<div class="weui-tab__bd">
		<div id="tab1" class="weui-tab__bd-item weui-tab__bd-item--active">
		@if(empty(count($Workyard)))<!-- 如果当前项目状态不正确 -->
			@include('weixin/partial/msg/msg', [
         		'type' => 'warn_primary',
         		'title'=> '禁止操作',
         		'desc' => '没有项目',
         		'action' => [
         			'primary' =>['title'=> '请先创建项目', 'href'=> '/weixin/workyard/add'],
         			'defualt' =>['title'=> '返回', 'href'=> 'javascript:history.back()'],
         		],
         	]) 
		@elseif($Workyard->status != 'ENABLED')<!-- 如果当前项目状态不正确 -->
			@include('weixin/partial/msg/msg', [
         		'type' => 'warn_primary',
         		'title'=> '禁止操作',
         		'desc' => '当前项目不可用',
         		'action' => [
         			'primary' =>['title'=> '返回', 'href'=> 'javascript:history.back()'],
         		],
         	]) 
		@elseif($role != 'WORKYARD_ADMIN')<!-- 判断当前用户角色  角色名称-->
			@include('weixin/partial/msg/msg', [
         		'type' => 'warn_primary',
         		'title'=> '禁止操作',
         		'desc' => '您当前角色不是项目管理员，请切换角色',
         		'action' => [
         			'primary' =>['title'=> '返回', 'href'=> 'javascript:history.back()'],
         		],
         	]) 
        @elseif($worker_role_status != 'WORKYARD_ADMIN_ENABLED')<!-- 判断当前用户角色  状态-->
        	@include('weixin/partial/msg/msg', [
         		'type' => 'warn_primary',
         		'title'=> '禁止操作',
         		'desc' => '您被禁用，无权添加',
         		'action' => [
         			'primary' =>['title'=> '返回', 'href'=> 'javascript:history.back()'],
         		],
         	]) 
		@else
		<form id="repaird-add" action="/api/repair-order/add" method="post" >
			<div class="weui-cells weui-cells_form">
				@include('weixin/partial/input/input', [
    				'label'=>'设备',
    				'require' => true,
    				'name'=>'select_repair_type',
    				'placeholder'=>'维修设备',
				])
				<!-- 紧急程度 -->
				@include('weixin/partial/input/input', [
    				'label'=>'紧急程度',
    				'require' => true,
    				'name'=>'select_grade',
    				'placeholder'=>'紧急程度',
				])
				<!-- contact-user -->
				@include('weixin/partial/input/input', [
    				'require' => true,
    				'label'=>'联系人',
    				'name'=>'contact_user',
    				'placeholder'=>'请输入联系人姓名',
				])
				<!-- contact-tel -->
				@include('weixin/partial/input/input', [
    				'require' => true,
    				'label'=>'联系人电话',
    				'name'=>'contact_tel',
    				'placeholder'=>'请输入联系人电话',
				])
				<!-- desc -->
				<div class="weui-cells__title">故障描述</div>
                <div class="weui-cells weui-cells_form">
                  <div class="weui-cell">
                    <div class="weui-cell__bd">
                      <textarea class="weui-textarea" name="desc" placeholder="请详细说明需维修情况" rows="5"></textarea>
                    </div>
                  </div>
                </div>
				<input type="hidden" name="workyard_id" value="{{ $Workyard->id }}">
				<input type="hidden" name="repair_type_id" value="">
				<input type="hidden" name="grade" value="">
			</div>
			@include('weixin/partial/button/submit', ['title'=>'提交保存'])
		</form>
		@endif
		</div>
	</div>
</div>
@endsection
