@extends('admin.layout.modal')

@section('title', '指定维修工程师')
@section('pageName', 'DistributePage')
@section('pageGroup', 'RepairOrder')

@section('modalBody')
<form id="form_distribute" action="/api/repair-order/distribute/{{ $repairOrder->id }}" method="post">
	<div class="alert alert-info">
    <strong>提示！</strong>可指定全职维修工程师，不可指定兼职维修工程师
    </div>
    
	<div class="form-group">
		<label class="control-label">订单编号：</label>
  		<p class="form-control-static">{{ $repairOrder->order }}</p>
	</div>
	 	
	<div class="form-group">
		<label class="control-label">选择维修工程师<span class="required"> * </span></label> 
		<select class="form-control" name="worker_id">
            <option value="">请选择...</option>
            @foreach($workers as $worker)
            <option value="{{ $worker->id }}">{{ $worker->realname }}</option>
            @endforeach
        </select>
	</div>
	
	<div class="margin-top-10">
		<button type="submit" class="btn green" disabled="disabled"> 提交保存 </button> 
	</div>
</form>
@endsection
