<div class="portlet light profile-sidebar-portlet bordered">
	<div class="profile-userpic">
		<img src="{{ $User->weixin_userinfo->headimgurl }}"
			class="img-responsive" alt="">
	</div>
	<div class="profile-usertitle">
		<div class="profile-usertitle-name">{{ $User->weixin_userinfo->nickname }}</div>
		<div class="profile-usertitle-job">当前身份：{{ $User->role_on_using->desc }}</div>
	</div>
</div>