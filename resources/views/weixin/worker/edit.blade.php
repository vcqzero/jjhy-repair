<?php 
use Illuminate\Support\Facades\Auth;

$user = Auth::user();
?>
@extends('weixin.layout.layout') @section('title', '编辑信息')
@section('pageName', 'EditPage') @section('pageGroup', 'Worker')

@section('page-title')
@include('weixin/partial/navbar/back', [
	'withBack' => true,
	'title' => '编辑信息'
])
@endsection('content')

@section('content')
<div class="weui-tab">
	<div class="weui-tab__bd">
		<div id="tab1" class="weui-tab__bd-item weui-tab__bd-item--active">
		<form id="worker-edit" action="/api/worker/edit" method="post" >
			<div class="weui-cells weui-cells_form">
				<!-- 地区 -->
				@include('weixin/partial/input/input', [
				'label'=>'所在地区',
				'require' => true,
				'name'=>'address_area_info',
				'placeholder'=>'请选择地区',
				])
				<!-- tel -->
				@include('weixin/partial/input/input', [
				'label'=>'手机号',
				'require' => true,
				'name'=>'tel',
				'placeholder'=>'请输入手机号',
				'value'=> $user->tel,
				])
				<!-- real_name -->
				@include('weixin/partial/input/input', [
				'label'=>'真实姓名',
				'require' => true,
				'name'=>'realname',
				'placeholder'=>'请输入真实姓名',
				'value'=> $user->realname,
				])
				<!-- desc -->
				<div class="weui-cells__title">技能描述</div>
                <div class="weui-cells weui-cells_form">
                  <div class="weui-cell">
                    <div class="weui-cell__bd">
                      <textarea 
                      class="weui-textarea" 
                      name="skill" placeholder="请输入技能描述"
                      rows="5">{{ $user->skill->skill }}</textarea>
                    </div>
                  </div>
                </div>
				<input type="hidden" name="address_area" value="{{ $user->province . ',' . $user->city . ',' . $user->district }}">
			</div>
			@include('weixin/partial/button/submit', ['title'=>'提交保存'])
		</form>
		</div>
	</div>
</div>
@endsection