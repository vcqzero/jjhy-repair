define(
	['jquery', 'App', 'daterangepicker'],
	function($, App) {
		var table = $('#worker-job-table')
		var btn_open_expoet_modal = $('.btn-open-export-modal')
		var expoet_modal = $('#export-modal')
		var simple_search_form = $('#simple-search-form')

		var bootstrapTable = [
			//正常状态
			{
				target: table,
				option: {
					url: '/worker/worker-job/table-data',
					search: false,
					sortName: 'confirmed_at', //string
					sortOrder: 'desc',
					toolbar: '#search-toolbar', //toolbar 选择器
					sidePagination: 'server',
					queryParamsType: 'not-limit',
					columns: [
						//维修单号
						{
							sortable: true,
							field: 'order',
							valign: 'middle',
							'class': 'td-width-15'
						},
						//维修工
						{
							sortable: true,
							field: 'worker_id',
							formatter: function(value, row, index, field) {
								var worker = row.worker
								return worker.realname
							},
							valign: 'middle',
						},
						//所属项目
						{
							field: 'workyard_name',
							formatter: function(value, row, index, field) {
								var workyard = row.workyard
								return workyard.name
							},
							valign: 'middle',
						},
						//开始时间
						{
							sortable: true,
							field: 'confirmed_at',
							valign: 'middle',
							'class': 'td-width-15'
						},
						//结束时间
						{
							sortable: true,
							field: 'completed_at',
							valign: 'middle',
							'class': 'td-width-15'
						},
						//评价
						{
							sortable: true,
							field: 'comment_star',
							formatter: function(value, row, index, field) {
								var comment_star = row.comment_star
								var comment_span
								switch(comment_star) {
									case(5):
										comment_span = '<span class="commet-star-fill">★★★★★</span> 5星'
										break;
									case(4):
										comment_span = '<span class="commet-star-fill">★★★★</span> 4星'
										break;
									case(3):
										comment_span = '<span class="commet-star-fill">★★★</span> 3星'
										break;
									case(2):
										comment_span = '<span class="commet-star-fill">★★</span> 2星'
									case(1):
										comment_span = '<span class="commet-star-fill">★</span> 1星'
										break;
								}
								return comment_span
							},
							valign: 'middle',
						},
						//评价内容
						{
							sortable: true,
							field: 'comment_desc',
							valign: 'middle',
						},
						//操作
						{
							formatter: function(value, row, index, field) {
								var id = row.id
								var status = row.status
								var view = '<a href="/repair-order/view/' + id + '"class="btn dark btn-sm btn-outline click-open-modal"> ' +
									'<i class="fa fa-share"></i> 查看</a>'
								return view
							},
							valign: 'middle',
						},

					],
					showExport: false, //是否显示导出按钮  
				},
			},
		]

		var init_export = function() {
			btn_open_expoet_modal.on('click', function() {
				//				expoet_modal.find('form').trigger('reset')
				expoet_modal.modal('show')
			})

			expoet_modal.on('click', '.btn-export-excel', function() {
				var form = expoet_modal.find('form')
				var query = form.serialize()
				var url = '/api/repair-order/export?' + query
				location = url
			})
		}
		var init_date_range_picker = function() {
			var _input = $('.my-date-range-picker')
			var _config = {
				//				singleDatePicker: true,
				startDate: moment().startOf('month').format('YYYY-MM-DD'),
				endDate: moment().format('YYYY-MM-DD'),
				//				minDate: moment(),
				ranges: {
					//					'今天': [moment(), moment()],
					//					'昨天': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
					//					'最近7天': [moment(), moment().add(6, 'days')],
					//					'最近30天': [moment().add(29, 'days'), moment()],
					'本月': [moment().startOf('month'), moment()],
					'上月': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
				},
				alwaysShowCalendars: true,
				locale: {
					applyLabel: '确认',
					cancelLabel: '取消',
					fromLabel: 'From',
					toLabel: 'To',
					customRangeLabel: '自定义',
					daysOfWeek: ['日', '一', '二', '三', '四', '五', '六'],
					monthNames: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
					firstDay: 1,
					//						format: 'YYYY-MM-DD hh:mm:ss',
					format: 'YYYY/MM/DD',
				}
			}
			_input.daterangepicker(_config);
			$('.drp-calendar').css('min-width', '320px')
		}

		var init_search = function() {
			var do_search = function(form) {
				var query = App.form.getQueryObj(form)
				table.bootstrapTable('refresh', {
					query: query
				})
			}
			simple_search_form.on('change', 'select', function() {
				do_search(simple_search_form)
			})

			simple_search_form.on('reset', function() {
				setTimeout(function() {
					do_search(simple_search_form)
				}, 50)
			})
		}

		return {
			init: function(pageName, page) {
				App.bootstrapTable(page, bootstrapTable)
				init_export()
				init_date_range_picker()
				init_search()
			}
		}
	})