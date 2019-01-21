<div class="portlet light profile-sidebar-portlet bordered">
	<!-- SIDEBAR USERPIC -->
	<div class="profile-userpic">
		<img src="{{ $user->avatar ? $identity->avatar : '/storage/avatar/user_avatar.png' }}"
		class="img-responsive" alt="个人头像" style="height: auto">
	</div>
	<!-- END SIDEBAR USERPIC -->
	<!-- SIDEBAR USER TITLE -->
	<div class="profile-usertitle">
		<div class="profile-usertitle-name">{{ $user->username }}</div>
		<div class="profile-usertitle-job">{{ $user->role_on_using->desc }}</div>
	</div>
	<!-- END SIDEBAR USER TITLE -->
</div>
<!-- END PORTLET MAIN -->
