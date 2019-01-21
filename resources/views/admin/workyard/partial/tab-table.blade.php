<div class="portlet light portlet-fit portlet-datatable bordered">
	@include('admin/partial/protlet/title')
	
	<div class="portlet-body">
<!-- 		<div class="table-toolbar" id="my-toolbar"> -->
<!-- 			<div class="row"> -->
<!-- 				<div class="col-md-6 col-sm-6 col-xs-6"> -->
<!-- 					<div class="btn-group"> -->
<!-- 						<a href="/workyard/add" class="btn blue sbold click-open-modal"> -->
<!-- 							<i class="fa fa-plus"></i> 新增 -->
<!-- 						</a> -->
<!-- 					</div> -->
<!-- 				</div> -->
<!-- 			</div> -->
<!-- 		</div> -->
<!-- 			<div id="{{ $toolbar_id ?? '' }}" class="table-toolbar"> -->
<!--               	<form class="form-inline boootstrap-table-search"> -->
<!--                     @include('admin/partial/search/address') -->
                    <!-- 筛选id -->
<!--                     <div class="form-group" > -->
<!--                         <label for="">ID：</label> -->
<!--                         <input type="text" class="form-control" placeholder="输入用户id"> -->
<!--                     </div> -->
                    
<!--                     <input type="hidden" id="address_area" name="address-area"> -->
<!--                     <button type="submit" class="btn btn-primary">搜索</button> -->
<!--                     <button type="reset" class="btn btn-default">清空</button> -->
<!--                 </form> -->
<!--             </div> -->
            
            <table class="table table-striped  table-hover table-checkable table-enabled"
            	id="{{ $table_id }}">
            	<thead>
            		<tr class="head">
            			<th data-field="id">ID</th>
            			<th data-field="name">名称</th>
            			<th data-field="address">地址</th>
            			<th data-field="desc">介绍</th>
            			<th data-field="updated_at">创建时间</th>
            			<th data-field="status">状态</th>
            			<th data-field="actions">操作</th>
            		</tr>
            	</thead>
            </table>
	</div>
</div>