define(
	['jquery', 'App', 'area'],
	function($, App, area) {
		var columns = [
			{
				sortable: true,
				field: 'id',
				valign: 'middle',
			},
			{
				field: 'realname',
				valign: 'middle',
			},
			{
				field: 'tel',
				valign: 'middle',
			},
			{
				//输出所在地区
				formatter: function(value, row, index, field) {
					var province = row.province
					var city = row.city
					var district = row.district
					var codes = province + ',' + city + ',' + district
					var address = area.getName(codes)
					return address
				},
				valign: 'middle',
			},
			//所辖工地
			{
				formatter: function(value, row, index, field) {
					var workyards = row.workyards
					return workyards.length
				},
				valign: 'middle',
			},
			{
				sortable: true,
				field: 'created_at',
				valign: 'middle',
			},
			//status
			{
				formatter: function(value, row, index, field) {
					var  roles	 	= row.roles_on_owning
					var  forbidden	= '<span class="label label-default"> 已禁用 </span>'
					var  enabled  	= '<span class="label label-success"> 正常 </span>'
					for(var key in roles) {
						var role = roles[key]
						if(role.name != 'WORKYARD_ADMIN') continue
						var status = role.pivot.status
						if(status == 'WORKYARD_ADMIN_ENABLED') return enabled
						if(status == 'WORKYARD_ADMIN_FORBIDDEN') return forbidden
					}
				},
				valign: 'middle',
			},
			{
				formatter: function(value, row, index, field) {
					var id = row.id
					var status = row.status
					var forbid = '<a href="/workyard-admin/forbid/' + id + '"class="btn red btn-sm btn-outline click-open-modal"> ' +
						'<i class="fa fa-lock"></i> 禁用</a>'
					var enable = '<a href="/workyard-admin/forbid/' + id + '"class="btn green btn-sm btn-outline click-open-modal"> ' +
						'<i class="fa fa-unlock"></i> 启用</a>'
					var view = '<a href="/workyard-admin/view/' + id + '"class="btn dark btn-sm btn-outline click-open-modal"> ' +
						'<i class="fa fa-share"></i> 查看</a>'
					var  roles	 	= row.roles_on_owning
					for(var key in roles) {
						var role = roles[key]
						if(role.name != 'WORKYARD_ADMIN') continue
						var status = role.pivot.status
						if(status == 'WORKYARD_ADMIN_ENABLED') return view + forbid
						if(status == 'WORKYARD_ADMIN_FORBIDDEN') return view + enable
					}	
				},
				valign: 'middle',
			},

		]
		
		var url = '/workyard-admin/table-data'
		var bootstrapTable = [{
				target: $('#table_enabled'),
				option: {
					url: url + '/WORKYARD_ADMIN_ENABLED',
					search: true,
					sortName: 'id', //string
					//				toolbar : '.search',
					columns: columns,
					exportOptions: {
						ignoreColumn: [7], //忽略某一列的索引
						fileName: '维修工列表_正在使用', //文件名称设置
					},
				},
			},
			{
				target: $('#table_forbidden'),
				option: {
					url: url + '/WORKYARD_ADMIN_FORBIDDEN',
					search: true,
					sortName: 'id', //string
					columns: columns,
					exportOptions: {
						ignoreColumn: [7], //忽略某一列的索引
						fileName: '维修工列表_已禁用', //文件名称设置
					},
				},
			},
		]
		return {
			init: function(pageName, page) {
				App.bootstrapTable(page, bootstrapTable)
			}
		}
	})