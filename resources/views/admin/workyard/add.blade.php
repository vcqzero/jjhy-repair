@extends('admin.layout.modal')

@section('title', '新增')
@section('pageName', 'AddPage')
@section('pageGroup', 'Workyard')

@section('modalBody')
<form id="form-add" action="/api/workyard/add" method="post">
	<div class="form-group">
		<label class="control-label">名称<span class="required"> * </span></label> 
		<input type="text" name="name" class="form-control" placeholder="请输入名称" />
	</div>
	<div class="form-group">
		<label class="control-label">选择地区<span class="required"> * </span></label> 
		<a href="javascript:;" class="pick-area pick-area1" style="width: 100%"></a>
	</div>
	<div class="form-group">
		<label class="control-label">具体地址<span class="required"> * </span></label> 
		<input type="text" name="address" class="form-control"placeholder="请输入具体地址" />
	</div>
	<div class="form-group">
		<label class="control-label">介绍</label> 
		<input type="text" name="desc" class="form-control"placeholder="选填：请输入介绍内容" />
	</div>
	<div class="margin-top-10">
		<button type="submit" class="btn green" disabled="disabled"> 提交保存 </button> 
	</div>
</form>
@endsection
