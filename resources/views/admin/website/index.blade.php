@extends('admin.layout.layout')

@section('title', '站点设置')
@section('pageName', 'WebsiteSettingPage')
@section('pageGroup', 'Website')
@section('content')
@csrf
<div class="note note-info">
            <h4 class="block">对管理后台，微信端等平台进行设置！</h4>
        </div>
<div class="portlet light">
	<div class="portlet-title tabbable-line">
		<div class="caption">
			<i class="icon-settings"></i> 
			<span
			class="caption-subject bold uppercase"> 站点设置 </span>
		</div>
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab-website-admin-setting" data-toggle="tab">管理后台</a></li>
<!-- 			<li><a href="#tab-email-settings" data-toggle="tab">邮箱配置</a></li> -->
<!-- 			<li><a href="#tab-api-settings" data-toggle="tab"> API接口 </a></li> -->
		</ul>
	</div>
	<div class="portlet-body">
        <div class="tab-content">
        <!-- tab-basic-info -->
        @include('admin.website.partial.tab-website-admin-setting')
        </div>
    </div>
</div>
@endsection
