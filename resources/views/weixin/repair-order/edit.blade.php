@extends('weixin.layout.layout') @section('title', '编辑维修单')
@section('pageName', 'EditPage') @section('pageGroup', 'RepairOrder')

@section('page-title')
@include('weixin/partial/navbar/back', [
	'withBack' => true,
	'title' => '编辑报修单'
])
@endsection('content')

@section('content')
<div class="weui-tab">
	<div class="weui-tab__bd">
		<div id="tab1" class="weui-tab__bd-item weui-tab__bd-item--active">
		<form id="repaird-edit" action="/api/repair-order/edit/{{ $RepairOrder->id }}" method="post" >
			<div class="weui-cells weui-cells_form">
				@include('weixin/partial/input/input', [
    				'label'=>'设备',
    				'name'=>'select_repair_type',
    				'placeholder'=>'维修设备',
    				'disabled' => true,
    				'value' => $RepairOrder->repair_type->name,
				])
				<!-- 紧急程度 -->
				@include('weixin/partial/input/input', [
    				'label'=>'紧急程度',
    				'require' => true,
    				'name'=>'select_grade',
    				'placeholder'=>'紧急程度',
    				'value' => $RepairOrder->repair_order_grade->desc,
				])
				<!-- contact-user -->
				@include('weixin/partial/input/input', [
    				'require' => true,
    				'label'=>'联系人',
    				'name'=>'contact_user',
    				'placeholder'=>'请输入联系人姓名',
    				'value' => $RepairOrder->contact_user,
				])
				<!-- contact-tel -->
				@include('weixin/partial/input/input', [
    				'require' => true,
    				'label'=>'联系人电话',
    				'name'=>'contact_tel',
    				'placeholder'=>'请输入联系人电话',
    				'value' => $RepairOrder->contact_tel,
				])
				<!-- desc -->
				<div class="weui-cells__title">故障描述</div>
                <div class="weui-cells weui-cells_form">
                  <div class="weui-cell">
                    <div class="weui-cell__bd">
                      <textarea 
                      class="weui-textarea" 
                      name="desc" 
                      placeholder="请详细说明需维修情况" 
                      rows="5">{{ $RepairOrder->desc }}</textarea>
                    </div>
                  </div>
                </div>
				<input type="hidden" name="repair_type_id" value="">
				<input type="hidden" name="grade" value="">
			</div>
			@include('weixin/partial/button/submit', ['title'=>'提交保存'])
		</form>
		</div>
	</div>
</div>
@endsection
