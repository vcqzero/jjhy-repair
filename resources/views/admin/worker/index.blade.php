@extends('admin.layout.layout')

@section('title', '维修工程师管理')
@section('pageName', 'IndexPage')
@section('pageGroup', 'Worker')

@section('content')
<div class="tabbable-line">
	<ul class="nav nav-tabs">
		
		<li class="active">
			<a href="#tab-worker-enabled" data-toggle="tab"
			aria-expanded="true">正常</a>
		</li>
		<li class="">
			<a href="#tab-worker-wait-check" data-toggle="tab"
			aria-expanded="true">待审核</a>
		</li>
		<li class="">
			<a href="#tab--worker-forbidden" data-toggle="tab"
			aria-expanded="false">已禁用</a>
		</li>
		<li class="">
			<a href="#tab-worker-fail-check" data-toggle="tab"
			aria-expanded="false">审核失败</a>
		</li>
	</ul>
	
	<div class="tab-content">
		<!-- 正常状态的维修工程师 -->
		<div class="tab-pane active" id="tab-worker-enabled">
			@include('admin.worker.partial.tab-worker', ['table_id' => 'worker-enabled'])
		</div>
		<!-- 待审核状态维修工程师 -->
		<div class="tab-pane" id="tab-worker-wait-check">
			@include('admin.worker.partial.tab-worker', ['table_id' => 'worker-wait-check'])
		</div>
		<!-- 审核失败工程师 -->
		<div class="tab-pane" id="tab-worker-fail-check">
			@include('admin.worker.partial.tab-worker', ['table_id' => 'worker-fail-check'])
		</div>
		<!-- 已禁用的维修工程师 -->
		<div class="tab-pane" id="tab--worker-forbidden">
			@include('admin.worker.partial.tab-worker', ['table_id' => 'worker_forbidden'])
		</div>
	</div>
</div>
@endsection
