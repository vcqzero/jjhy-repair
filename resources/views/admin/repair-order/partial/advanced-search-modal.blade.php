<div class="modal fade" data-delete="false" tabindex="-1" data-name="SearchPage" data-group="Retiree"
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
					id="advanced-search-form">
					
					<div class="form-body">
						<div class="form-group">
							<label class="col-md-3 control-label">姓名：</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name"
									placeholder="输入姓名">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 control-label">身份证号码：</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="id_card"
									placeholder="输入身份证号码">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 control-label">性别：</label>
							<div class="col-md-6">
								<select name="sex" class="form-control">
									<option value="">选择性别...</option>
									<option value="女">女</option>
									<option value="男">男</option>
								</select>
							</div>
						</div>
						
						<!-- 出生时间 -->
						<div class="form-group">
							<label class="col-md-3 control-label">出生日期：</label>
							<div class="col-md-6">
								<div class="input-daterange input-group" id="">
                                    <input type="text" 
                                    class="form-control" 
                                    name="birthday_start" 
                                    placeholder="开始时间"
                                    />
                                    <span class="input-group-addon">至</span>
                                    <input type="text" class="form-control" 
                                    placeholder="截止时间"
                                    name="birthday_end" />
                                </div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">现状：</label>
							<div class="col-md-6">@include('status/partial/select-status')</div>
						</div>
						<!-- 退休时间段 -->
						<div class="form-group">
							<label class="col-md-3 control-label">退休时间：</label>
							<div class="col-md-6">
								<div class="input-daterange input-group" id="">
                                    <input type="text" 
                                    class=" form-control" 
                                    name="retired_start" 
                                    placeholder="开始时间"
                                    />
                                    <span class="input-group-addon">至</span>
                                    <input type="text" class=" form-control" 
                                    placeholder="截止时间"
                                    name="retired_end" />
                                </div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 control-label">民族：</label>
							<div class="col-md-6">
								<select name="people" class="form-control">
									<option value="">选择民族...</option>
								</select>
							</div>
						</div>

						<!-- 		<div class="form-group"> -->
						<!-- 			<label class="col-md-3 control-label">本人电话：</label> -->
						<!-- 			<div class="col-md-6"> -->
						<!-- 				<input  -->
						<!-- 				type="text"  -->
						<!-- 				class="form-control"  -->
						<!-- 				name="mobile_phone" -->
						<!-- 				placeholder="输入电话号码"> -->
						<!-- 			</div> -->
						<!-- 		</div> -->

						<div class="form-group">
							<label class="col-md-3 control-label">单位：</label>
							<div class="col-md-6">@include('group/partial/select-groups')</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 control-label">政治面貌：</label>
							<div class="col-md-6">
								@include('politics/partial/select-politics')</div>
						</div>

						<!-- 		<div class="form-group"> -->
						<!-- 			<label class="col-md-3 control-label">家属姓名：</label> -->
						<!-- 			<div class="col-md-6"> -->
						<!-- 				<input  -->
						<!-- 				type="text"  -->
						<!-- 				class="form-control"  -->
						<!-- 				name="family_name" -->
						<!-- 				placeholder="家属姓名"> -->
						<!-- 			</div> -->
						<!-- 		</div> -->
						<!-- 		<div class="form-group"> -->
						<!-- 			<label class="col-md-3 control-label">家属联系方式：</label> -->
						<!-- 			<div class="col-md-6"> -->
						<!-- 				<input  -->
						<!-- 				type="text"  -->
						<!-- 				class="form-control"  -->
						<!-- 				name="family_phone" -->
						<!-- 				placeholder="家属联系方式"> -->
						<!-- 			</div> -->
						<!-- 		</div> -->
						<!-- 		<div class="form-group"> -->
						<!-- 			<label class="col-md-3 control-label">单位电话：</label> -->
						<!-- 			<div class="col-md-6"> -->
						<!-- 				<input  -->
						<!-- 				type="text"  -->
						<!-- 				class="form-control"  -->
						<!-- 				name="group_phone" -->
						<!-- 				placeholder="单位电话"> -->
						<!-- 			</div> -->
						<!-- 		</div> -->
						<!-- 		<div class="form-group"> -->
						<!-- 			<label class="col-md-3 control-label">住宅电话：</label> -->
						<!-- 			<div class="col-md-6"> -->
						<!-- 				<input  -->
						<!-- 				type="text"  -->
						<!-- 				class="form-control"  -->
						<!-- 				name="home_phone" -->
						<!-- 				placeholder="住宅电话"> -->
						<!-- 			</div> -->
						<!-- 		</div> -->

						<div class="form-group">
							<label class="col-md-3 control-label">职级：</label>
							<div class="col-md-6">@include('grade/partial/select-grades')</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">健康状况：</label>
							<div class="col-md-6">@include('health/partial/select-healths')</div>
						</div>
						
						
						
						
						<div class="form-group">
							<label class="col-md-3 control-label">就餐情况：</label>
							<div class="col-md-6">@include('meal/partial/select-meals')</div>
						</div>

					</div>
					<div class="form-actions" style="background-color: #fff;">
						<div class="row">
							<div class="col-md-offset-3 col-md-9"> 
							<button type="button" class="btn btn-default btn-clear-search hidden"> 
							<i class="fa fa-refresh"></i> 清空筛选</button>
							
							<button type="button" 
							class="btn blue btn-outline btn-export btn-export-excel hidden" >
                    			导出Excel</button>	
                    			
							<button type="button" 
							class="btn green btn-outline btn-export btn-export-csv hidden" >
                    			导出CSV</button>
                    								
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