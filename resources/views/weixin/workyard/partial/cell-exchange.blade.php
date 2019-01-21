<?php 
use Illuminate\Support\Facades\Auth;

$User = Auth::user();
$Workyards = $User->workyards;
$workyard_id = $Workyard->id;
?>
<div class="weui-cells__title">切换项目</div>
<div class="weui-cells">
<a class="weui-cell weui-cell_access open-popup" href="javascript:;"
	data-target="#exchange-workyard">
	<div class="weui-cell__hd">
		<i class="fa fa-exchange"></i>
	</div>
	<div class="weui-cell__bd">
		<p>切换项目</p>
	</div>
	<div class="weui-cell__ft">切换项目</div>
</a>
</div>
<!-- popup -->
<div id="exchange-workyard" class="weui-popup__container popup-bottom">
	<div class="weui-popup__overlay"></div>
	<div class="weui-popup__modal">
		<div class="toolbar">
			<div class="toolbar-inner">
				<a href="javascript:;" class="picker-button close-popup">关闭</a>
				<h1 class="title">切换项目</h1>
			</div>
		</div>
		<div class="modal-content">
			<div class="weui-cells weui-cells_radio">
				@foreach($Workyards as $Workyard)
				<label class="weui-cell weui-check__label">
					<div class="weui-cell__bd">
						<p>{{ $Workyard->name }}</p>
					</div>
					
					<div class="weui-cell__ft">
					@if($workyard_id == $Workyard->id)
					<input type="radio" 
					value="{{ $Workyard->id }}"
					class="weui-check" name="workyard_id" checked="checked"> 
					@else
					<input type="radio" 
					value="{{ $Workyard->id }}"
					class="weui-check exchange-workyard" name="workyard_id"> 
					@endif
					<span class="weui-icon-checked"></span>
					</div>
				</label> 
				@endforeach
			</div>
			<div class="weui-btn-area">
				<a href="/weixin/workyard/add" class="weui-btn weui-btn_primary">新增项目</a>
			</div>
		</div>
	</div>
</div>
