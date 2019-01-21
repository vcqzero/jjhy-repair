@extends('admin.layout.layout')

@section('title', '报修管理')
@section('pageName', 'ListPage')
@section('pageGroup', 'RepairOrder')
<!-- section -->
@section('btn-group')
<a href="" class="btn blue sbold "><i class="fa fa-plus"></i> 新增</a>
@endsection

@section('content')
<div class="tabbable-line">
	<ul class="nav nav-tabs">
		<li class="active">
			<a href="#tab-list-wait-offer" data-toggle="tab"
			aria-expanded="true">抢单中</a>
		</li>
		<li class="">
			<a href="#tab-list-wait-distribute" data-toggle="tab"
			aria-expanded="true">待派单</a>
		</li>
		
		<li class="">
			<a href="#tab_working" data-toggle="tab"
			aria-expanded="true">维修中</a>
		</li>
		
		<li class="">
			<a href="#tab-list-completed" data-toggle="tab"
			aria-expanded="true">维修完成</a>
		</li>
		
		<li class="">
			<a href="#tab--list-closed" data-toggle="tab"
			aria-expanded="false">订单关闭<span class="badge badge-warning count-check hide" ></span> </a>
		</li>
	</ul>
	
	<div class="tab-content">
		<!-- the orders wait worker offer -->
		<div class="tab-pane active" id="tab-list-wait-offer">
			@include('admin.repair-order.partial.tab-list-wait-offer')
		</div>
		
		<!-- wait admin to distribute -->
		<div class="tab-pane" id="tab-list-wait-distribute">
			@include('admin.repair-order.partial.tab-wait-distribute')
		</div>
		
		<!-- working -->
		<div class="tab-pane" id="tab_working">
			@include('admin.repair-order.partial.tab_working')
		</div>
		
		<!-- tab-list-completed -->
		<div class="tab-pane" id="tab-list-completed">
			@include('admin.repair-order.partial.tab_completed')
		</div>
		
		<!-- tab--list-closed -->
		<div class="tab-pane" id="tab--list-closed">
			@include('admin.repair-order.partial.tab_closed')
		</div>
	</div>
</div>
@endsection
@section('table')

<table
class="table table-striped  table-hover table-checkable "
id="users-list">
<thead>
	<tr class="head">
		<th class="th_5" data-field="">
		</th>
		<th class="th_15" data-field="">
		用户名
		</th>
		<th class="th_15" data-field="realname">真实姓名</th>
		<th class="th_15" data-field="tel">电话</th>
		<th class="column_status">状态</th>
		<th data-field="role">角色</th>
		<th data-field="">操作</th>
	</tr>
	
</thead>
</table>
@endsection
