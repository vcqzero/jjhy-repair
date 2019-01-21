@extends('admin.layout.layout')

@section('title', '基本设置')
@section('pageName', 'SettingsPage')
@section('pageGroup', 'Settings')
@section('content')
@csrf
<div class="note note-info">
            <h4 class="block">管理项目，微信等设置！</h4>
        </div>
<div class="portlet light">
	<div class="portlet-title tabbable-line">
		<div class="caption">
			<i class="icon-settings"></i> 
			<span
			class="caption-subject bold uppercase"> 基本设置 </span>
		</div>
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab-settings-workyard" data-toggle="tab">项目设置</a></li>
			<li><a href="#tab-email-settings" data-toggle="tab">维修工程师设置</a></li>
<!-- 			<li><a href="#tab-api-settings" data-toggle="tab"> API接口 </a></li> -->
		</ul>
	</div>
	<div class="portlet-body">
        <div class="tab-content">
        <!-- tab-basic-info -->
        @include('admin.website.partial.tab-settings-workyard')
        </div>
    </div>
</div>
@endsection
