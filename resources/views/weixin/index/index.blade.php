@extends('weixin.layout.layout') @section('title', '设备维修')
@section('pageName', 'IndexPage') @section('pageGroup', 'Index')

@section('content')
<div class="weui-tab">

	<div class="weui-tab__bd">
		<div id="tab-repair-order-container" class="weui-tab__bd-item weui-tab__bd-item--active" style="top:0">
			<header class="demos-header">
                <div class="demos-title">设备维修</div>
            </header>
			<!-- 搜索部分 -->
			@include('weixin/index/partial/search')
			<!-- 维修单container -->
			<div class="show-empty" id="repair-order-container">
				@include('weixin/index/paginator')
			</div>
			<!-- 显示维修单详情popup -->
			@include('weixin/partial/popup/popup', [
			'id'    => 'popup-offer-manage',
			'title' => '维修详情'
			])
		</div>
	</div>
	@include('weixin/partial/tarbar/main')
</div>
@endsection
