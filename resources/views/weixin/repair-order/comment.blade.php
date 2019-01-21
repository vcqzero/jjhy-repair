<!-- 评价订单 -->

@extends('weixin.layout.layout') @section('title', '评价订单')
@section('pageName', 'CommentPage') @section('pageGroup', 'RepairOrder')

@section('page-title')
@include('weixin/partial/navbar/back', [
	'withBack' => true,
	'title' => '评价维修服务'
])
@endsection('content')

@section('content')
<div class="weui-tab">
	<div class="weui-tab__bd">
		<div id="tab1" class="weui-tab__bd-item weui-tab__bd-item--active">
		<form id="comment-form" action="/api/repair-order/comment/{{ $repairOrder->id }}" method="post" >
			<div class="weui-cells">
              <div class="weui-cell">
                <div class="weui-cell__bd">
                  <p>订单编号</p>
                </div>
                <div class="weui-cell__ft">{{ $repairOrder->order }}</div>
              </div>
            </div>
            
			<div class="weui-cells__title">选择评价等级</div>
			<div class="weui-cells weui-cell_access select-comment-star">
              <div class="weui-cell">
                <div class="weui-cell__bd">
                  <p>选择评价</p>
                </div>
                <div class="weui-cell__ft"><p><span class="commet-star-fill">★★★★★</span> 5星</p></div>
              </div>
            </div>
            
            <div class="weui-cells__title">输入评价内容</div>
			<!-- desc -->
            <div class="weui-cells weui-cells_form">
              <div class="weui-cell">
                <div class="weui-cell__bd">
                  <textarea 
                  class="weui-textarea" 
                  name="comment_desc" 
                  placeholder="输入评价内容" rows="3"></textarea>
                </div>
              </div>
            </div>
			<input type="hidden" name="comment_star" value="5">
			@include('weixin/partial/button/submit', ['title'=>'提交保存'])
		</form>
		</div>
	</div>
</div>
@include('weixin/repair-order/partial/popup-submit-comment')
@endsection
