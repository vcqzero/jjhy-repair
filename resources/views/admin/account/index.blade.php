@extends('admin.layout.layout')

@section('title', '个人中心')
@section('pageName', 'IndexPage')
@section('pageGroup', 'Account')
<!-- section -->
@section('content')
@csrf
<div class="profile-sidebar">
	<!-- PORTLET MAIN -->
	@include('admin.account.partial.profile')
	<!-- END PORTLET MAIN -->
</div>
<div class="profile-content">
	<div class="row">
		<div class="col-md-12">
			<div class="portlet light bordered">
				<div class="portlet-title tabbable-line">
					<div class="caption caption-md">
						<i class="icon-globe theme-font hide"></i> <span
							class="caption-subject font-blue-madison bold uppercase">账户信息</span>
					</div>
					<ul class="nav nav-tabs">
						<li class="active"><a href="#tab_1_1" data-toggle="tab">基本信息</a></li>
						<li><a href="#tab_1_2" data-toggle="tab">设置头像</a></li>
						<li><a href="#tab_1_3" data-toggle="tab">更改密码</a></li>
					</ul>
				</div>
				<div class="portlet-body">
					<div class="tab-content">
						<!-- PERSONAL INFO TAB -->
						@include('admin.account.partial.tab-person-info')
						<!-- END PERSONAL INFO TAB -->
						<!-- CHANGE AVATAR TAB -->
						@include('admin.account.partial.tab-avatar')
						<!-- END CHANGE AVATAR TAB -->
						<!-- CHANGE PASSWORD TAB -->
						@include('admin.account.partial.tab-password')
						<!-- END CHANGE PASSWORD TAB -->
						<!-- PRIVACY SETTINGS TAB -->
						@include('admin.account.partial.tab-oauth')
						<!-- END PRIVACY SETTINGS TAB -->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
