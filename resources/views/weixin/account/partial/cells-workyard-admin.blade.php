<div class="weui-cells__title">当前项目</div>
@if(count($Workyard = $User->workyard))
<div class="weui-cells">
	<!-- name -->
	@include('weixin/workyard/partial/cell-name', ['Workyard'=> $Workyard])
	<!-- address-area -->
	@include('weixin/workyard/partial/cell-address-area', ['Workyard'=> $Workyard])
	<!-- address-info -->
	@include('weixin/workyard/partial/cell-address-info', ['Workyard'=> $Workyard])
	<!-- desc -->
	@include('weixin/workyard/partial/cell-desc', ['Workyard'=> $Workyard])
	<!-- status -->
	@include('weixin/workyard/partial/cell-status', ['Workyard'=> $Workyard])
	<!-- can edit if enabled -->
	@include('weixin/workyard/partial/cell-edit-or-re-check', ['Workyard'=> $Workyard])
	<!-- 报单 -->
	
</div>
    <!-- 切换项目 -->
	@include('weixin/workyard/partial/cell-exchange', ['Workyard'=> $Workyard])
@else
    <!-- 如果没有项目 -->
    @include('weixin/workyard/partial/cell-add', ['Workyard'=> $Workyard])
@endif
