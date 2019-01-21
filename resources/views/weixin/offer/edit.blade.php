@extends('weixin.layout.layout') @section('title', '修改报价')
@section('pageName', 'EditPage') @section('pageGroup', 'Offer')

@section('page-title')
@include('weixin/partial/navbar/back', [
	'withBack' => true,
	'title' => '修改报价'
])
@endsection('content')

@section('content')
<div class="weui-tab">
	<div class="weui-tab__bd">
		<div id="tab1" class="weui-tab__bd-item weui-tab__bd-item--active">
		<form id="offer-edit" action="/api/offer/edit/{{ $offer->id }}" method="post" >
			<div class="weui-cells weui-cells_form">
				<!-- 报价 -->
				@if($offer->price > 0)
    				@include('weixin/partial/input/input', [
    				'label'=>'报价（￥）',
    				'require' => true,
    				'name'=>'price',
    				'value'=> $offer->price,
    				'placeholder'=>'请填写报价',
    				])
				@endif
				<!-- 预计工期 -->
				@include('weixin/partial/input/input', [
				'label'=>'工期（天）',
				'require' => true,
				'name'=>'days',
				'value'=> $offer->days,
				'placeholder'=>'请输入预期工期',
				])
			</div>
			@include('weixin/partial/button/submit', ['title'=>'提交保存'])
		</form>
		</div>
	</div>
</div>
@endsection