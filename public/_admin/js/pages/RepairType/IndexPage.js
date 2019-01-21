define(
	['jquery', 'App'],
	function($, App) {
		var bootstrapTable = [{
			target: $('#item-types'),
			option: {
				url: '/api/repair-type',
				search: true,
				sortName: 'id',
				//				toolbar : '.search',
				columns: [{
						sortable: true,
						valign: 'middle',
					},
					{
						sortable: true,
						field: 'name',
						valign: 'middle',
					},
					{
						sortable: true,
						field: 'desc',
						valign: 'middle',
					},
					{
						sortable: true,
						field: 'created_at',
						valign: 'middle',
					},
					{
						sortable: true,
						field: 'updated_at',
						valign: 'middle',
					},
					{
						formatter: function(value, row, index, field) {
							var id = row.id
							var view = '<a href="<?=$href?>"class="btn dark btn-sm btn-outline "> ' +
								'<i class="fa fa-share"></i> 查看</a>'
							var edit = '<a href="/repair-type/edit/' + id + '" class="btn green btn-sm btn-outline click-open-modal"> ' +
								'<i class="fa fa-edit"></i> 编辑</a>'
							var _delete = '<a href="/repair-type/delete/' + id + '" class="btn red btn-sm btn-outline click-open-modal"> ' +
								'<i class="fa fa-trash-o"></i> 删除</a>'
							return edit + _delete;
						},
						valign: 'middle',
					},
				],

				exportOptions: {
					ignoreColumn: [5],  //忽略某一列的索引
					fileName: 'questionNaireName', //文件名称设置
				},
			},
		}]
		return {
			init: function(pageName, page) {
				App.bootstrapTable(page, bootstrapTable)
			}
		}
	})