@switch($Workyard->status) 
	@case('ENABLED') 
	<a
	class="weui-cell weui-cell_access" id=""
	href="/weixin/workyard/edit/{{ $Workyard->id }}">
	<div class="weui-cell__hd">
		<i class="fa fa-edit"></i>
	</div>
	<div class="weui-cell__bd">
		<p class="">管理项目</p>
	</div>
	<div class="weui-cell__ft">修改项目信息</div>
	</a> 
	@break 
	
	<!-- 审核未通过，需要重新提交审核 -->
	@case('CHECK_FAILED')
	<div class="weui-cell">
    	<div class="weui-cell__hd">
    		<i class="fa fa-edit"></i>
    	</div>
    	<div class="weui-cell__bd">
    		<p class="text-danger">审核</p>
    	</div>
    	<div class="weui-cell__ft">
    	@foreach ($Workyard->checkWorkyardRecords as $record) 
    		@if($loop->last) 
    		{{ $record->desc }} 
    		@endif 
    	@endforeach
    	</div>
    </div>
    
    <a class="weui-cell weui-cell_access" id=""
    	href="/weixin/workyard/edit/{{ $Workyard->id }}">
    	<div class="weui-cell__hd">
    		<i class="fa fa-edit"></i>
    	</div>
    	<div class="weui-cell__bd">
    		<p class="text-primary">修改信息</p>
    	</div>
    	<div class="weui-cell__ft">修改之后，重新提交</div>
    </a> 
	@break 
@endswitch