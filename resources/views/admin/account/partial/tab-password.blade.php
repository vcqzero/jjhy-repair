<div class="tab-pane" id="tab_1_3">
	<form id="form-password" action="/api/account/password" method="post">
		<div class="form-group">
			<label class="control-label">当前密码<span class="required"> * </span></label> 
			<input type="password" id="old-password" name="old-password" class="form-control" />
		</div>
		<div class="form-group">
			<label class="control-label">新密码<span class="required"> * </span></label> 
			<input type="password" id="password" name="password" class="form-control" />
		</div>
		<div class="form-group">
			<label class="control-label">再次输入新密码<span class="required"> * </span></label> 
			<input type="password" id="repeat-password" name="repeat-password" class="form-control" />
		</div>
		<div class="margin-top-10">
			<button type="submit" class="btn green" disabled="disabled"> 保存 </button> 
		</div>
	</form>
</div>