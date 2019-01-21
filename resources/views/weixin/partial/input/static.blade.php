<?php 
if(empty($label)) $label= '';
if(empty($value)) $value = '';
?>
<div class="weui-cell">
	<div class="weui-cell__hd">
		<label class="weui-label">
		{{ $label }}
		</label>
	</div>
	<div class="weui-cell__bd">
		<input 
		type="text" 
		class="weui-input"
		value="{{ $value }}"
		disabled="disabled"/>
	</div>
</div>
