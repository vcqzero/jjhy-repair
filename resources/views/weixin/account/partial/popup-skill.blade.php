<?php
use Illuminate\Support\Facades\Auth;

$user = Auth::user();
?>
<div id="popup-skill" class="weui-popup__container">
	<div class="weui-popup__overlay"></div>
	<div class="weui-popup__modal">
		<div class="toolbar">
			<div class="toolbar-inner">
				<a href="javascript:;" class="picker-button close-popup">关闭</a>
				<h1 class="title">技能描述</h1>
			</div>
		</div>
		<div style="margin-top: 50px; max-width: 100%">
			<div class="weui-cells weui-cells_form">
				<div class="weui-cell">
					<div class="weui-cell__bd">
						<textarea 
						class="weui-textarea" 
						placeholder="请输入文本"
						readonly="readonly" 
						rows="10">{{ $user->skill->skill }}</textarea>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>