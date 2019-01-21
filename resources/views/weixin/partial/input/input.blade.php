<?php 
if(empty($label)) $label= '';
if(empty($name)) $name= '';
if(empty($value)) $value = '';
if(empty($id)) $id= '';
if(empty($placeholder)) $placeholder = '';
if(empty($disabled)) $disabled = false;
?>
<div class="weui-cell">
	<div class="weui-cell__hd">
		<label class="weui-label">
		{{ $label }}
		@if(!empty($require))
		<span class="required"> * </span>
		@endif
		</label>
	</div>
	<div class="weui-cell__bd">
		<input 
		type="text" 
		name="{{ $name }}" 
		class="weui-input"
		value="{{ $value }}"
		id="{{ $id }}"
		<?php if($disabled):?>
		disabled="disabled"
		<?php endif;?>
		placeholder="{{ $placeholder }}" />
	</div>
</div>
