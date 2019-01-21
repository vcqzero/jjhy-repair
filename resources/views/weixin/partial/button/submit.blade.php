<div class="weui-btn-area">
	<button class="weui-btn weui-btn_primary" type="submit">
	@if($title)
	{{ $title }}	
	@else
	提交保存
	@endif
	</button>
	<a href="javascript:history.back();"class="weui-btn weui-btn_default">返回</a>
</div>