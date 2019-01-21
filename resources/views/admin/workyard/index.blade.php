@extends('admin.layout.layout') 
@section('title', '项目管理')
@section('pageName', 'IndexPage') 
@section('pageGroup', 'Workyard')

@section('content')
<div class="tabbable-line">
	<ul class="nav nav-tabs">
		<li class="active">
			<a href="#tab-workyard-enabled" data-toggle="tab"
			aria-expanded="true"> 正在使用 </a>
		</li>
		
		<li class="">
			<a href="#tab-workyard-check" data-toggle="tab"
			aria-expanded="false"> 待审核 </a>
		</li>
		
		<li class="">
			<a href="#tab-workyard-check-failed" data-toggle="tab"
			aria-expanded="false"> 审核失败 </a>
		</li>
			
		<li class="">
			<a href="#tab-workyard-forbidden" data-toggle="tab"
			aria-expanded="false"> 已禁用 </a>
		</li>
	</ul>
	
	<div class="tab-content">
		<!-- 正在使用的 -->
		<div class="tab-pane active" id="tab-workyard-enabled">
			@include('admin.workyard.partial.tab-table', [
			'table_id' 	=> 'workyards_enabled',
			])
		</div>
		<!-- 待审核的-->
		<div class="tab-pane" id="tab-workyard-check">
			@include('admin.workyard.partial.tab-table', ['table_id' => 'workyards_wait_check'])
		</div>
		<!-- 已禁用-->
		<div class="tab-pane" id="tab-workyard-forbidden">
			@include('admin.workyard.partial.tab-table', ['table_id' => 'workyards_forbidden'])
		</div>
		<!-- 审核失败-->
		<div class="tab-pane" id="tab-workyard-check-failed">
			@include('admin.workyard.partial.tab-table', ['table_id' => 'workyards_check_failed'])
		</div>
	</div>
</div>
@endsection
