@extends('weixin.layout.layout') @section('title', '提交资料')
@section('pageName', 'AddInfoPage') @section('pageGroup', 'Worker')

@section('page-title')
@include('weixin/partial/navbar/back', [
	'withBack' => true,
	'title' => '提交资料'
])
@endsection('content')

@section('content')
<div class="weui-tab">
	<div class="weui-tab__bd">
		<div id="tab1" class="weui-tab__bd-item weui-tab__bd-item--active">
		<form id="worker-add-info" action="/api/worker/add" method="post" >
			<div class="weui-cells__title">1：基本信息</div>
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
				])
				<!-- real_name -->
				@include('weixin/partial/input/input', [
				'label'=>'真实姓名',
				'require' => true,
				'name'=>'realname',
				'placeholder'=>'请输入真实姓名',
				])
				<!-- desc -->
				<div class="weui-cells__title">技能描述</div>
                <div class="weui-cells weui-cells_form">
                  <div class="weui-cell">
                    <div class="weui-cell__bd">
                      <textarea class="weui-textarea" name="skill" placeholder="请输入技能描述" rows="5"></textarea>
                    </div>
                  </div>
                </div>
				<input type="hidden" name="address_area">
			</div>
			@include('weixin/partial/button/submit', ['title'=>'下一步：提交保险单'])
		</form>
		</div>
	</div>
</div>
@endsection
