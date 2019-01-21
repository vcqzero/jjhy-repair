define(
	['jquery', 'App', 'area'],
	function($, App, area) {
		var status = function(value, row, index, field) {
			var id = row.id
			var repair_order_status = row.repair_order_status
			var status_name = repair_order_status.name
			var status_desc = repair_order_status.desc
			switch(status_name) {
				case 'WAIR_WORKER':
					status_dom = '<span class="label label-primary">' + status_desc + '</span>'
					break
				case 'WAIT_DISTRIBUTE':
					var distribute = '<a href="/repair-order/distribute/' + id + '"class="btn blue btn-sm btn-outline click-open-modal"> ' +
						'<i class="fa fa-magic"></i> 立即派单</a>'
					status_dom = '<span class="label label-primary margin_right_10">' + status_desc + '</span>'
					status_dom = status_dom
					break
				case 'WORKING':
					status_dom = '<span class="label label-info">' + status_desc + '</span>'
					break
				case 'COMPLETED':
					status_dom = '<span class="label label-success">' + status_desc + '</span>'
					break
				case 'CLOSED':
					status_dom = '<span class="label label-default">' + status_desc + '</span>'
					break
			}
			return status_dom;
		}
		var grade = function(value, row, index, field) {
			var type = row.repair_order_grade
			var name = type.desc
			return name
		}
		var workyard = function(value, row, index, field) {
			var workyard = row.workyard
			return workyard.name
		}
		var actions = function(value, row, index, field) {
			var id = row.id
			var status = row.status
			var view = '<a href="/repair-order/view/' + id + '"class="btn dark btn-sm btn-outline click-open-modal"> ' +
				'<i class="fa fa-share"></i> 查看</a>'

			var distribute = '<a href="/repair-order/distribute/' + id + '"class="btn blue btn-sm btn-outline click-open-modal"> ' +
				'<i class="fa fa-magic"></i> 派单</a>'

			var can_offer = '<a href="/repair-order/set-can-offer/' + id + '"class="btn green btn-sm btn-outline click-open-modal"> ' +
				'<i class="fa fa-exchange"></i> 设为抢单</a>'

			var close = '<a href="/repair-order/close/' + id + '" class="btn red btn-sm btn-outline click-open-modal"> ' +
				'<i class="fa fa-close"></i> 关闭订单</a>'

			var pay = '<a href="/repair-order/pay/' + id + '" class="btn green btn-sm btn-outline click-open-modal"> ' +
				'<i class="fa fa-unlock"></i> 垫付资金</a>'

			switch(status) {
				case 'WAIT_DISTRIBUTE':
					return distribute + view + can_offer + close
					break
				case 'WAIR_WORKER':
					return view + distribute + close
					break
				case 'WORKING':
					return view
					break
				case 'COMPLETED':
					return view
					break
				case 'CLOSED':
					return view
					break
			}
		}
		var repair_type_name = function(value, row, index, field) {
			var type = row.repair_type
			var name = type.name
			return name
		}

		//输出维修工信息
		var worker = function(value, row, index, field) {
			var worker = row.worker
			var name = worker.realname
			return name
		}
		//输出维修工信息
		var price = function(value, row, index, field) {
			var offer = row.offer
			if(offer.length < 1) return '-'
			return offer.price + '（￥）'
		}
		var days = function(value, row, index, field) {
			var offer = row.offer
			if(offer.length < 1) return '-'
			return offer.days + '（天）'
		}
		var real_days = function(value, row, index, field) {
			var days = row.days
			return days + '（天）'
		}
		
		var comment_star = function(value, row, index, field) {
			var comment_star = row.comment_star
			var comment_span 
			switch(comment_star) {
				case (5) :
				comment_span = '<span class="commet-star-fill">★★★★★</span> 5星'
				break;
				case (4):
				comment_span = '<span class="commet-star-fill">★★★★</span> 4星'
				break;
				case (3):
				comment_span = '<span class="commet-star-fill">★★★</span> 3星'
				break;
				case (2):
				comment_span = '<span class="commet-star-fill">★★</span> 2星'
				case (1):
				comment_span = '<span class="commet-star-fill">★</span> 1星'
				break;
			}
			return comment_span
		}

		var desc = function(value, row, index, field) {
			var desc = row.desc
			var length = desc.length
			var sub_length = 20
			var desc_sub = desc.substr(0, sub_length)
			if(length > sub_length) return desc_sub + '...'
			return desc_sub
		}

		var address = function(value, row, index, field) {
			var workyard = row.workyard
			var province = workyard.province
			var city = workyard.city
			var district = workyard.district
			var codes = province + ',' + city + ',' + district
			var address = area.getName(codes)
			return address
		}

		var _url = '/repair-order/table-data'
		var bootstrapTable = [
			//等待维修工抢单
			{
				target: $('#order-wait-offer'),
				'option': {
					url: _url + '/WAIR_WORKER',
					search: true,
					sortName: 'id', //string
					columns: [
						//oredr
						{
							sortable: true,
							field: 'order',
							valign: 'middle',
							align: 'left',
							'class': 'td-width-15'
						},
						//workyard
						{
							sortable: true,
							formatter: workyard,
							valign: 'middle',
						},
						//repair_type_name
						{
							formatter: repair_type_name,
							valign: 'middle',
						},
						//desc
						{
							sortable: true,
							field: 'desc',
							valign: 'middle',
						},
						//grade
						{
							sortable: true,
							formatter: grade,
							valign: 'middle',
						},
						//created_at
						{
							sortable: true,
							field: 'created_at',
							valign: 'middle',
						},
						//status
						{
							formatter: status,
							valign: 'middle',
						},
						//actions
						{
							formatter: actions,
							valign: 'middle',
							'class': 'td-width-20'
						},
					],
					exportOptions: {
						ignoreColumn: [7], //忽略某一列的索引
						fileName: '维修订单_待报价', //文件名称设置
					},
				},
			},
			//等待管理员派单
			{
				target: $('#table_wait_distribute'),
				'option': {
					url: _url + '/WAIT_DISTRIBUTE',
					search: true,
					sortName: 'id', //string
					//				toolbar : '.search',
					columns: [
						//oredr
						{
							sortable: true,
							field: 'order',
							valign: 'middle',
							align: 'left',
							'class': 'td-width-15'
						},
						//workyard
						{
							sortable: true,
							formatter: workyard,
							valign: 'middle',
						},
						//repair_type_name
						{
							formatter: repair_type_name,
							valign: 'middle',
						},
						//desc
						{
							sortable: true,
							field: 'desc',
							valign: 'middle',
						},
						//grade
						{
							sortable: true,
							formatter: grade,
							valign: 'middle',
						},
						//created_at
						{
							sortable: true,
							field: 'created_at',
							valign: 'middle',
						},
						//status
						{
							formatter: status,
							valign: 'middle',
						},
						//actions
						{
							formatter: actions,
							valign: 'middle',
							'class': 'td-width-25'
						},
					],
					exportOptions: {
						ignoreColumn: [8], //忽略某一列的索引
						fileName: '维修工列表_已禁用', //文件名称设置
					},
					onLoadSuccess: function(data) {
						var _a = $('[href="#tab-list-wait-distribute"]').first()
						var data = data.data
						var count = data.length
						App.badge(_a, count)
					},
				},
			},
			//正在维修中的
			{
				target: $('#table_working'),
				option: {
					url: _url + '/WORKING',
					search: true,
					sortName: 'id', //string
					//				toolbar : '.search',
					columns: [
						//oredr
						{
							sortable: true,
							field: 'order',
							valign: 'middle',
							align: 'left',
							'class': 'td-width-15'
						},
						//workyard
						{
							sortable: true,
							formatter: workyard,
							valign: 'middle',
						},
						//repair_type_name
						{
							formatter: repair_type_name,
							valign: 'middle',
						},
						//desc
						{
							sortable: true,
							field: 'desc',
							valign: 'middle',
						},
						//worker
						{
							formatter: worker,
							valign: 'middle',
						},
						//confirmed_at
						{
							sortable: true,
							field: 'confirmed_at',
							valign: 'middle',
							'class': 'td-width-15'
						},

						//status
						{
							formatter: status,
							valign: 'middle',
						},
						//actions
						{
							formatter: actions,
							valign: 'middle',
							'class': 'td-width-10'
						},
					],
					exportOptions: {
						ignoreColumn: [8], //忽略某一列的索引
						fileName: '维修工列表_已禁用', //文件名称设置
					},
				},
			},
			//订单完成
			{
				target: $('#table_completed'),
				option: {
					url: _url + '/COMPLETED',
					search: true,
					sortName: 'id', //string
					//				toolbar : '.search',
					columns: [
						//oredr
						{
							sortable: true,
							field: 'order',
							valign: 'middle',
							align: 'left',
							'class': 'td-width-15'
						},
						//workyard
						{
							sortable: true,
							formatter: workyard,
							valign: 'middle',
						},
						//repair_type_name
						{
							formatter: repair_type_name,
							valign: 'middle',
						},
						//desc
						{
							sortable: true,
							field: 'desc',
							valign: 'middle',
						},
						//worker
						{
							formatter: worker,
							valign: 'middle',
						},
						//confirmed_at
						{
							sortable: true,
							field: 'confirmed_at',
							valign: 'middle',
							'class': 'td-width-15'
						},
						//completed_at
						{
							sortable: true,
							field: 'completed_at',
							valign: 'middle',
							'class': 'td-width-15'
						},

						//comment_star
						{
							formatter: comment_star,
							valign: 'middle',
						},
						
						//status
						{
							formatter: status,
							valign: 'middle',
						},
						//actions
						{
							formatter: actions,
							valign: 'middle',
							'class': 'td-width-10'
						},
					],
					exportOptions: {
						ignoreColumn: [9], //忽略某一列的索引
						fileName: '维修工列表_已禁用', //文件名称设置
					},
				},
			},
			//订单关闭
			{
				target: $('#table_closed'),
				option: {
					url: _url + '/CLOSED',
					search: true,
					sortName: 'id', //string
					//				toolbar : '.search',
					columns: [ 
						//oredr
						{
							sortable: true,
							field: 'order',
							valign: 'middle',
							align: 'left',
							'class': 'td-width-15'
						},
						//workyard
						{
							sortable: true,
							formatter: workyard,
							valign: 'middle',
						},
						//repair_type_name
						{
							formatter: repair_type_name,
							valign: 'middle',
						},
						//desc
						{
							sortable: true,
							field: 'desc',
							valign: 'middle',
						},
						//grade
						{
							sortable: true,
							formatter: grade,
							valign: 'middle',
						},
						//created_at
						{
							sortable: true,
							field: 'created_at',
							valign: 'middle',
						},
						//updated_at
						{
							sortable: true,
							field: 'updated_at',
							valign: 'middle',
						},
						//status
						{
							formatter: status,
							valign: 'middle',
						},
						//actions
						{
							formatter: actions,
							valign: 'middle',
							'class': 'td-width-10'
						},
					],
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