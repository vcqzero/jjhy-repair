
<table id="websiteTable" class="table table-bordered table-striped">
	<tbody>
		<tr>
			<td style="width: 10%">是否需审核</td>
			<td style="width: 40%">
			<a 
			href="javascript:;" 
			id="title"
			data-pk="1"
			data-type="select" 
			data-original-title="是否需要审核"
			data-emptytext="未设置"
			data-name="need_check_workyard_on_create"
			data-value="{{ $check }}"
			class="editable editable-click edit-settings-check" tabindex="-1"
			style="display: inline;width: 90%"></a>
			</td>
			<td style="width: 50%">创建项目是否需要审核</td>
		</tr>
		<tr>
			<td style="width: 10%">是否可抢单</td>
			<td style="width: 40%">
			<a 
			href="javascript:;" 
			id="title"
			data-pk="1"
			data-type="select" 
			data-original-title=""
			data-emptytext="未设置"
			data-name="can_offer_repair_order"
			data-value="{{ $offer }}"
			class="editable editable-click edit-settings-offer" tabindex="-1"
			style="display: inline;width: 90%"></a>
			</td>
			<td style="width: 50%">新增维修单派单方式</td>
		</tr>
		<!-- 报价时是否可填写价格 -->
		<tr>
			<td style="width: 10%">是否可填写价格</td>
			<td style="width: 40%">
			<a 
			href="javascript:;" 
			id="title"
			data-pk="1"
			data-type="select" 
			data-original-title=""
			data-emptytext="未设置"
			data-name="can_offer_price"
			data-value="{{ $offer_price }}"
			class="editable editable-click edit-settings-offer-price" tabindex="-1"
			style="display: inline;width: 90%"></a>
			</td>
			<td style="width: 50%">报价时是否可填写价格</td>
		</tr>
	</tbody>
</table>
