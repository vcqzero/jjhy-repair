<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">审核操作</h3>
	</div>
	<div class="panel-body">
	<form id="form-check" action="/api/worker/check/{{ $worker->id }}" method="post">
    	<div class="form-group">
            <label>审核<span class="required"> * </span></label>
            <div class="mt-radio-inline">
                <label class="mt-radio text-success">
                    <input type="radio" name="status" value="WORKER_ENABLED">审核通过
                    <span></span>
                </label>
                <label class="mt-radio text-danger">
                    <input type="radio" name="status" value="WORKER_FAILED_CHECK">审核未通过
                    <span></span>
                </label>
            </div>
        </div>
    	<div class="margin-top-10">
    		<button type="submit" class="btn green" disabled="disabled"> 提交保存 </button> 
    	</div>
    </form>
	</div>
</div>