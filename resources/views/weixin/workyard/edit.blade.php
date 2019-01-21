@extends('weixin.layout.layout') @section('title', '编辑项目')
@section('pageName', 'EditPage') @section('pageGroup', 'Workyard')

@section('page-title')
@include('weixin/partial/navbar/back', [
	'withBack' => true,
	'title' => '编辑项目'
])
@endsection('content')

@section('content')
<div class="weui-tab">
	<div class="weui-tab__bd">
		<div id="tab1" class="weui-tab__bd-item weui-tab__bd-item--active">
		<form id="workyard-edit" action="/api/workyard/edit/{{ $Workyard->id }}" method="post" >
			<div class="weui-cells weui-cells_form">
				<!-- 名称 -->
				@include('weixin/partial/input/input', [
				'label'=>'项目名称',
				'require' => true,
				'name'=>'name',
				'value' => $Workyard->name,
				'placeholder'=>'请输入项目名称',
				])
				<!-- 地区 -->
				@include('weixin/partial/input/input', [
				'label'=>'具体地址',
				'require' => true,
				'name'=>'address_area_info',
				'placeholder'=>'请选择地区',
				])
				<!-- 请输入具体地址 -->
				@include('weixin/partial/input/input', [
				'label'=>'具体地址',
				'require' => true,
				'value' => $Workyard->address,
				'name'=>'address',
				'placeholder'=>'请输入具体地址',
				])
				<!-- desc -->
				@include('weixin/partial/input/input', [
				'label'=>'介绍',
				'name'=>'desc',
				'value' => $Workyard->desc,
				'placeholder'=>'选填：请输入介绍内容',
				])
				<input type="hidden" id="workyard_id" value="{{ $Workyard->id }}">
				<input type="hidden" name="address_area" value="{{ $Workyard->province . ',' . $Workyard->city . ',' . $Workyard->district }}">
				@if ($Workyard->status == 'CHECK_FAILED')
				<input type="hidden" name="status" value="WAIT_CHECK">
				@endif
			</div>
			@include('weixin/partial/button/submit', ['title'=>'提交保存'])
		</form>
		</div>
	</div>
</div>
@endsection
