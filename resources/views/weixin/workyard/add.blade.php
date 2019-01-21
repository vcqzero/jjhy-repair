<?php 
use Illuminate\Support\Facades\Auth;

$user = Auth::user();
$Workyard = $user->workyard;

//用户角色
$role = $user->role;
$worker_role = $user->roles_on_owning()->where('name', 'WORKYARD_ADMIN')->first();
$worker_role_status = $worker_role->pivot->status;
?>
@extends('weixin.layout.layout') @section('title', '新增项目')
@section('pageName', 'AddPage') @section('pageGroup', 'Workyard')

@section('page-title')
@include('weixin/partial/navbar/back', [
	'withBack' => true,
	'title' => '新增项目'
])
@endsection('content')

@section('content')
<div class="weui-tab">
	<div class="weui-tab__bd">
		<div id="tab1" class="weui-tab__bd-item weui-tab__bd-item--active">
		@if($role != 'WORKYARD_ADMIN')<!-- 判断当前用户角色  角色名称-->
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
		<form id="workyard-add" action="/api/workyard/add" method="post" >
			<div class="weui-cells weui-cells_form">
				<!-- 名称 -->
				@include('weixin/partial/input/input', [
				'label'=>'项目名称',
				'require' => true,
				'name'=>'name',
				'placeholder'=>'请输入项目名称',
				])
				<!-- 地区 -->
				@include('weixin/partial/input/input', [
				'label'=>'所在地区',
				'require' => true,
				'name'=>'address_area_info',
				'placeholder'=>'请选择地区',
				])
				<!-- 请输入具体地址 -->
				@include('weixin/partial/input/input', [
				'label'=>'具体地址',
				'require' => true,
				'name'=>'address',
				'placeholder'=>'请输入具体地址',
				])
				<!-- desc -->
				@include('weixin/partial/input/input', [
				'label'=>'介绍',
				'name'=>'desc',
				'placeholder'=>'选填：请输入介绍内容',
				])
				<input type="hidden" name="address_area">
			</div>
			@include('weixin/partial/button/submit', ['title'=>'提交保存'])
		</form>
		@endif
		</div>
	</div>
</div>
@endsection
