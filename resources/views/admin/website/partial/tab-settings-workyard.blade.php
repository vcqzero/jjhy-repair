<div class="tab-pane active" id="tab-settings-workyard">
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
			data-name="check"
			data-value="{{ $settings['workyard']['check'] }}"
			class="editable editable-click edit-settings-check" tabindex="-1"
			style="display: inline;width: 90%"></a>
			</td>
			<td style="width: 50%">创建项目是否需要审核</td>
		</tr>
	</tbody>
</table>
</div>