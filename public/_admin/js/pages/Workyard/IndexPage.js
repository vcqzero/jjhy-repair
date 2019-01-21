define(
	['jquery', 'App', 'area', 'pickArear'],
	function($, App, area) {
		//输出所在地区
		var address = function(value, row, index, field) {
			var province = row.province
			var city = row.city
			var district = row.district
			var codes = province + ',' + city + ',' + district
			var address = area.getName(codes)
			return address
		}
		//输出状态
		var status = function(value, row, index, field) {
			var status = row.status
			var status_desc
			switch(status) {
				case 'WAIT_CHECK':
					status_desc = '<span class="label label-warning"> 等待审核 </span>'
					break
				case 'CHECK_FAILED':
					status_desc = '<span class="label label-danger"> 审核未通过 </span>'
					break
				case 'ENABLED':
					status_desc = '<span class="label label-success"> 正常 </span>'
					break
				case 'FORBIDDEN':
					status_desc = '<span class="label label-default"> 已禁用 </span>'
					break
			}
			return status_desc;
		}
		//输出actions
		var actions = function(value, row, index, field) {
			var id = row.id
			var status = row.status
			var view = '<a href="/workyard/view/' + id + '"class="btn dark btn-sm btn-outline click-open-modal"> ' +
				'<i class="fa fa-share"></i> 查看</a>'
			var check = '<a href="/workyard/check/' + id + '"class="btn green btn-sm btn-outline click-open-modal"> ' +
				'<i class="fa fa-check"></i> 审核</a>'
			var forbid = '<a href="/workyard/forbid/' + id + '" class="btn red btn-sm btn-outline click-open-modal"> ' +
				'<i class="fa fa-lock"></i> 禁用</a>'
			var enabled = '<a href="/workyard/forbid/' + id + '" class="btn green btn-sm btn-outline click-open-modal"> ' +
				'<i class="fa fa-unlock"></i> 启用</a>'

			switch(status) {
				case 'WAIT_CHECK':
					return view + check;
					break;

				case 'CHECK_FAILED':
					return view;
					break;

				case 'ENABLED':
					return view + forbid;
					break;
				case 'FORBIDDEN':
					return view + enabled;
					break;
			}
		}
		var columns = [{
				sortable: true,
				field: 'id',
				valign: 'middle',
			},
			{
				sortable: true,
				field: 'name',
				valign: 'middle',
			},
			{
				sortable: true,
				formatter: address,
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
				formatter: status,
				valign: 'middle',
			},
			{
				formatter: actions,
				valign: 'middle',
			},
		]
		var url = '/workyard/table-data'
		var bootstrapTable = [
			//正常状态的
			{
				target: $('#workyards_enabled'),
				option: {
					url: url + '/ENABLED',
//					toolbar: '#workyards_enabled_toobar',
//					search: false,
					//					buttonsAlign: "left", //按钮位置  
					sortName: 'id', //string
					columns: columns,

					exportOptions: {
						ignoreColumn: [6], //忽略某一列的索引
						fileName: '项目列表_正在使用', //文件名称设置
					},
				},
			},
			//待审核的
			{
				target: $('#workyards_wait_check'),
				option: {
					url: url + '/WAIT_CHECK',
//					search: false,
					sortName: 'id', //string
					columns: columns,

					onLoadSuccess: function(data) {
						var data = data.data
						var count = data.length
						var target = $('[href="#tab-workyard-check"]').first()
						App.badge(target, count)
					},

					exportOptions: {
						ignoreColumn: [6], //忽略某一列的索引
						fileName: '项目列表_待审核', //文件名称设置
					},
				},
			},
			//审核失败
			{
				target: $('#workyards_check_failed'),
				option: {
					url: url + '/CHECK_FAILED',
					search: true,
					sortName: 'id', //string
					//				toolbar : '.search',
					columns: columns,
					exportOptions: {
						ignoreColumn: [6], //忽略某一列的索引
						fileName: '项目列表_审核失败', //文件名称设置
					},
				},
			},
			//被禁用
			{
				target: $('#workyards_forbidden'),
				option: {
					url: url + '/FORBIDDEN',
					search: true,
					sortName: 'id', //string
					//				toolbar : '.search',
					columns: columns,
					exportOptions: {
						ignoreColumn: [6], //忽略某一列的索引
						fileName: '项目列表_已禁用', //文件名称设置
					},
				},
			},
		]

		var pickArear = function() {
			var target = $('a.pick-area')
			var _input = $('input[name="address-area"]')
			App.pickArea(target, _input)
		}

		return {
			init: function(pageName, page) {
				App.bootstrapTable(page, bootstrapTable)
//				pickArear()
			}
		}
	})