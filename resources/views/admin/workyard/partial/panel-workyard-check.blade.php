<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">审核操作</h3>
	</div>
	<div class="panel-body">
	<form id="form-check" action="/api/workyard/check/{{ $Workyard->id }}" method="post">
    	<div class="form-group">
            <label>审核<span class="required"> * </span></label>
            <div class="mt-radio-inline">
                <label class="mt-radio text-success">
                    <input type="radio" name="status" value="ENABLED">审核通过
                    <span></span>
                </label>
                <label class="mt-radio text-danger">
                    <input type="radio" name="status" value="CHECK_FAILED">审核失败
                    <span></span>
                </label>
            </div>
        </div>
    	<div class="form-group">
    		<label class="control-label">备注内容</label> 
    		<input type="text" name="desc" class="form-control"placeholder="如审核失败，请填写失败原因" />
    	</div>
    	<div class="margin-top-10">
    		<button type="submit" class="btn green" disabled="disabled"> 提交保存 </button> 
    	</div>
    </form>
	</div>
</div>