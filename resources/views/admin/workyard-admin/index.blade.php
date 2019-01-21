@extends('admin.layout.layout')

@section('title', '项目管理员')
@section('pageName', 'IndexPage')
@section('pageGroup', 'WorkyardAdmin')

@section('content')
<div class="tabbable-line">
	<ul class="nav nav-tabs">
		<li class="active">
			<a href="#tab_enabled" data-toggle="tab"
			aria-expanded="true">正常</a>
		</li>
		
		<li class="">
			<a href="#tab_forbidden" data-toggle="tab"
			aria-expanded="false">已禁用</a>
		</li>
	</ul>
	
	<div class="tab-content">
		<!-- 正常状态的项目管理员 -->
		<div class="tab-pane active" id="tab_enabled">
			@include('admin.workyard-admin.partial.tab_table', ['table_id' => 'table_enabled'])
		</div>
		<!-- 已禁用的项目管理员 -->
		<div class="tab-pane" id="tab_forbidden">
			@include('admin.workyard-admin.partial.tab_table', ['table_id' => 'table_forbidden'])
		</div>
	</div>
</div>
@endsection
