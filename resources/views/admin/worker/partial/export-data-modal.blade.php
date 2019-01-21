<div class="modal fade" id="export-modal" data-delete="false" tabindex="-1" data-name="" data-group=""
	role="dialog" aria-labelledby="myModalLabel" style="display: none;">
	<div class="modal-dialog " role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
					aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
				<h4 class="modal-title">高级查询</h4>
			</div>
			<div class="modal-body form">
				<form class="form-horizontal search-form" role="form"
					id="export-data-form">
					
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-3 control-label">维修工程师：</label>
							<div class="col-md-6">
								@include('admin/worker/partial/select-worker')
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">项目：</label>
							<div class="col-md-6">
								@include('admin/workyard/partial/select-workyard')
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">接单时间：</label>
							<div class="col-md-6">
								<input type="text" 
								name="confirmed_at_range" 
								class="form-control my-date-range-picker"
								placeholder="请输入接单时间段" />
							</div>
						</div>
<!-- 						<div class="form-group"> -->
<!-- 							<label class="col-md-3 control-label">完工时间：</label> -->
<!-- 							<div class="col-md-6"> -->
<!-- 								<input type="text"  -->
<!-- 								name="completed_at_range"  -->
<!-- 								class="form-control my-date-range-picker" -->
<!-- 								placeholder="请输入完工时间段" /> -->
<!-- 							</div> -->
<!-- 						</div> -->
						<div class="form-group">
							<label class="col-md-3 control-label">评价：</label>
							<div class="col-md-6">
							@include('admin/worker/partial/select-comment-star')
							</div>
						</div>
					</div>
					<div class="form-actions" style="background-color: #fff;">
						<div class="row">
							<div class="col-md-offset-3 col-md-9"> 
    							<button type="button" 
    							class="btn blue btn-outline btn-export btn-export-excel" >
                        			导出Excel</button>	
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
			</div>
		</div>
	</div>
</div>