@extends('admin.layout.layout')

@section('title', 'API接口')
@section('pageName', 'ApiSettingPage')
@section('pageGroup', 'Website')
@section('content')
@csrf
<div class="note note-info">
            <h4 class="block">可设置本邮箱、微信api等内容</h4>
            <p>如需更改，请站点管理员修改env文件</p>
        </div>
<div class="portlet light">
	<div class="portlet-title tabbable-line">
		<div class="caption">
			<i class="icon-settings"></i> 
			<span
			class="caption-subject bold uppercase">API接口</span>
		</div>
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab-api-email-settings" data-toggle="tab">邮箱接口</a></li>
			<li><a href="#tab-api-weixin-settings" data-toggle="tab">微信设置</a></li>
		</ul>
	</div>
	<div class="portlet-body">
        <div class="tab-content">
        <!-- tab-basic-info -->
        @include('admin.website.partial.tab-api-email-settings')
        @include('admin.website.partial.tab-api-weixin-settings')
        </div>
    </div>
</div>
@endsection
