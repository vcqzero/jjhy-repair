<?php
use Illuminate\Support\Facades\Auth;

$user = Auth::user();
$role = $user->roles_on_owning()
    ->where('name', $user->role)
    ->first();
$status = $role->pivot->status;
?>
<!-- 如果未提交资料 -->
@if($status == 'WORKER_WAIT_INIT')
    <!-- 还没有提交资料 -->
    @include('weixin/worker/partial/account-cells-need-add-info')

<!-- 已提交资料，未上传证书 -->
@elseif($status == 'WORKER_ADD_CERTIFICATE')
	<div class="weui-cells__title">维修工程师</div>
	<div class="weui-cells">
    	<!-- 输出基本资料 -->
    	@include('weixin/worker/partial/account-cell-basic-info')
    	<!-- 输出上传保险单按钮 -->
    	@include('weixin/worker/partial/account-cell-add-certificate')
	</div>
<!-- 已提交资料，等待审核 -->
@elseif($status == 'WORKER_WAIT_CHECK')
	<div class="weui-cells__title">维修工程师</div>
	<div class="weui-cells">
    	<!-- 输出基本资料 -->
    	@include('weixin/worker/partial/account-cell-basic-info')
    	<!-- 输出查看保险单-->
    	@include('weixin/worker/partial/account-cell-view-certificate')
    	<!-- 输出状态 -->
    	@include('weixin/worker/partial/account-cell-status', [
    		'class'=>'text-primary',
    		'title'=>'等待审核'
    	])
	</div>
<!-- 已提交资料，审核失败 -->
@elseif($status == 'WORKER_FAILED_CHECK')
	<!-- 提示重新添加资料 -->
	@include('weixin/worker/partial/account-cells-re-need-add-info')

<!-- 已提交资料，审核成功，正常状态-->
@elseif($status == 'WORKER_ENABLED')
	<div class="weui-cells__title">维修工程师</div>
	<div class="weui-cells">
    	<!-- 输出基本资料 -->
    	@include('weixin/worker/partial/account-cell-basic-info')
    	<!-- 输出查看保险单-->
    	@include('weixin/worker/partial/account-cell-view-certificate')
    	<!-- 输出状态 -->
    	@include('weixin/worker/partial/account-cell-status', [
    		'class'=>'',
    		'title'=>'正常'
    	])
    	<!-- 可进行编辑-->
    	@include('weixin/worker/partial/account-cell-edit-info')
	</div>

<!-- 已提交资料，账户禁用-->
@else
	<div class="weui-cells__title">维修工程师</div>
	<div class="weui-cells">
    	<!-- 输出基本资料 -->
    	@include('weixin/worker/partial/account-cell-basic-info')
    	<!-- 输出查看保险单-->
    	@include('weixin/worker/partial/account-cell-view-certificate')
    	<!-- 输出状态 -->
    	@include('weixin/worker/partial/account-cell-status', [
    		'class'=>'text-danger',
    		'title'=>'已禁用'
    	])
	</div>
@endif

