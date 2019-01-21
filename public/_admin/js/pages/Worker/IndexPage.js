define(
	['jquery', 'App', 'area'],
	function($, App, area) {
		var type = function(value, row, index, field) {
			var roles = row.roles_on_owning
			for(var key in roles) {
				var role = roles[key]
				var role_name = role.name
				if(role_name == 'WORKER') {
					var type = role.pivot.worker_type
					if(type == 'PART_TIME') {
						return '兼职'
					}
					if(type == 'FULL_TIME') {
						return '全职'
					}
				}
			}
		}

		var address = function(value, row, index, field) {
			var province = row.province
			var city = row.city
			var district = row.district
			var codes = province + ',' + city + ',' + district
			var address = area.getName(codes)
			return address
		}

		var skill = function(value, row, index, field) {
			var skill = row.skill
			var skill_content = skill['skill'] ? skill['skill'] : '-'
			return skill_content.substr(0, 20)
		}

		var actions = function(value, row, index, field) {
			var id = row.id
			var status = row.status
			var forbid = '<a href="/worker/forbid/' + id + '"class="btn red btn-sm btn-outline click-open-modal"> ' +
				'<i class="fa fa-lock"></i> 禁用</a>'
			var view = '<a href="/worker/view/' + id + '"class="btn dark btn-sm btn-outline click-open-modal"> ' +
				'<i class="fa fa-share"></i> 查看</a>'
			var enable = '<a href="/worker/forbid/' + id + '"class="btn green btn-sm btn-outline click-open-modal"> ' +
				'<i class="fa fa-unlock"></i> 启用</a>'
			var check = '<a href="/worker/check/' + id + '"class="btn green btn-sm btn-outline click-open-modal"> ' +
				'<i class="fa fa-check"></i> 审核</a>'

			var set_type = '<a href="/worker/type/FULL_TIME/' + id + '"class="btn blue btn-sm btn-outline click-open-modal"> ' +
				'<i class="fa fa-unlock"></i> 设为全职</a>'
			var roles = row.roles_on_owning
			for(var key in roles) {
				var role = roles[key]
				if(role.name != 'WORKER') continue
				var type = role.pivot.worker_type
				if(type == 'FULL_TIME') {
					set_type = '<a href="/worker/type/PART_TIME/' + id + '"class="btn green btn-sm btn-outline click-open-modal"> ' +
								'<i class="fa fa-user"></i> 设为兼职</a>'
				}
				var status = role.pivot.status
				if(status == 'WORKER_ENABLED') return view + forbid + set_type
				if(status == 'WORKER_FORBIDDEN') return view + enable
				if(status == 'WORKER_WAIT_CHECK') return check
				if(status == 'WORKER_FAILED_CHECK') return view
			}
		}

		var status = function(value, row, index, field) {
			var roles = row.roles_on_owning
			var forbidden = '<span class="label label-default"> 已禁用 </span>'
			var enabled = '<span class="label label-success"> 正常 </span>'
			var wait_check = '<span class="label label-warning"> 等待审核 </span>'
			var fail_check = '<span class="label label-danger"> 审核未通过 </span>'
			for(var key in roles) {
				var role = roles[key]
				if(role.name != 'WORKER') continue
				var status = role.pivot.status
				if(status == 'WORKER_ENABLED') return enabled
				if(status == 'WORKER_FORBIDDEN') return forbidden
				if(status == 'WORKER_WAIT_CHECK') return wait_check
				if(status == 'WORKER_FAILED_CHECK') return fail_check
			}
		}

		var columns = [{
				sortable: true,
				field: 'id',
				valign: 'middle',
			},
			{
				formatter: type,
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
				formatter: address,
				valign: 'middle',
			},
			{
				//输出技能信息
				formatter: skill,
				valign: 'middle',
				'class': 'td-width-15'
			},
			{
				sortable: true,
				field: 'created_at',
				valign: 'middle',
			},
			{
				formatter: status,
				valign: 'middle',
			},
			{
				formatter: actions,
				valign: 'middle',
			},

		]

		var bootstrapTable = [
			//正常状态
			{
				target: $('#worker-enabled'),
				option: {
					url: '/worker/table-data/WORKER_ENABLED',
					search: true,
					sortName: 'id', //string
					//				toolbar : '.search',
					columns: columns,
					exportOptions: {
						ignoreColumn: [8], //忽略某一列的索引
						fileName: '维修工列表_正在使用', //文件名称设置
					},
				},
			},
			//已禁用
			{
				target: $('#worker_forbidden'),
				option: {
					url: '/worker/table-data/WORKER_FORBIDDEN',
					search: true,
					sortName: 'id', //string
					//				toolbar : '.search',
					columns: columns,
					exportOptions: {
						ignoreColumn: [8], //忽略某一列的索引
						fileName: '维修工列表_已禁用', //文件名称设置
					},
				},
			},
			//待审核
			{
				target: $('#worker-wait-check'),
				option: {
					url: '/worker/table-data/WORKER_WAIT_CHECK',
					search: true,
					sortName: 'id', //string
					//				toolbar : '.search',
					columns: columns,
					exportOptions: {
						ignoreColumn: [8], //忽略某一列的索引
						fileName: '维修工列表_待审核', //文件名称设置
					},
					onLoadSuccess: function(data) {
						var _a = $('[href="#tab-worker-wait-check"]').first()
						var data = data.data
						var count = data.length
						App.badge(_a, count)
					},
				},
			},
			//审核失败
			{
				target: $('#worker-fail-check'),
				option: {
					url: '/worker/table-data/WORKER_FAILED_CHECK',
					search: true,
					sortName: 'id', //string
					//				toolbar : '.search',
					columns: columns,
					exportOptions: {
						ignoreColumn: [8], //忽略某一列的索引
						fileName: '维修工列表_审核失败', //文件名称设置
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