@extends('admin.layout.modal')

@section('modalSize', 'modal-sm')

@if($type == 'FULL_TIME')
@section('title', '设置为全职?')
@else
@section('title', '设置为兼职?')
@endif

@section('pageName', 'TypePage')
@section('pageGroup', 'Worker')

@section('modalBody')
<form id="form_type" action="/api/worker/type/{{ $type }}/{{ $id }}" method="post">
	<div class="form-group">
		<label class="control-label">ID:</label>
		<p class="form-control-static">{{ $id }}</p> 
	</div>
	<div class="margin-top-10">
		<button type="submit" class="btn green" disabled="disabled"> 提交</button> 
	</div>
</form>
@endsection
