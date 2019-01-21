@extends('admin.layout.layout-table')

@section('title', '工作统计')
@section('pageName', 'WorkerJobPage')
@section('pageGroup', 'Worker')

@section('table-toolbar')
<div class="table-toolbar" id="">
	<div class="row">
		<div class="col-md-6 col-sm-6 col-xs-6">
			<div class="btn-group">
			<button 
			class="btn blue sbold btn-open-export-modal "
			><i class="fa fa-download"></i> 数据导出</button>
			</div>
		</div>
	</div>
</div>
@endsection

@section('table')

<div id="search-toolbar" class="table-toolbar" style="margin-top: 20px">
	<form action="" id="simple-search-form" class="">
        <div class="form-inline" role="form">
            <div class="form-group">
              <span>项目: </span>
              @include('admin/workyard/partial/select-workyard')
            </div>
            <div class="form-group">
              <span>工程师: </span>
              @include('admin/worker/partial/select-worker')
            </div>
            <div class="form-group">
              <span>评价: </span>
              @include('admin/worker/partial/select-comment-star')
            </div>
        	<button type="reset" class="btn btn-default btn-clear-search"> <i class="fa fa-refresh"></i> 清空筛选</button>
        </div>
	</form>
</div>

<table
class="table table-striped  table-hover table-checkable"
id="worker-job-table">
<thead>
	<tr class="head">
		<th data-field="order">维修单号</th>
		<th data-field="">工程师</th>
		<th data-field="">所属项目</th>
		<th data-field="">接单时间</th>
		<th data-field="">完工时间</th>
		<th data-field="">维修评价</th>
		<th data-field="">评价内容</th>
		<th data-field="">操作</th>
	</tr>
</thead>
</table>
@include('admin/worker/partial/export-data-modal')
@endsection
