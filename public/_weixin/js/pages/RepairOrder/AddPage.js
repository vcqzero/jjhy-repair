define(
	['jquery', 'App'],
	function($, App) {
		
		var validate = {
			'repaird-add': {
				rules: {
					'select_repair_type': {
						required: true,
					},

					'select_grade': {
						required: true,
					},

					'contact_user': {
						required: true,
						maxlength: 10,
					},
					
					'contact_tel': {
						required: true,
						phone: true,
					},

					desc: {
						required: true,
						maxlength: 500,
					},
				},

				messages: {

					'select_repair_type': {
						required: '请选择维修设备',
					},

					'select_grade': {
						required: '请选择紧急程度',
					},

					'contact_user': {
						required: '请输入联系人',
						maxlength: '联系人限制在10个字',
					},
					
					'contact_tel': {
						required: '请输入联系方式',
//						phone: true,
					},

					desc: {
						required: '请详细说明需维修情况',
						maxlength: '具体描述500字以内',
					},

				},

				//submit success
				resultSuccess: function() {
					var resObj = arguments[0]
					var form = arguments[1]
					$.toptip('操作成功', 2000, 'success'); //设置显
					location = '/weixin/repair-order'
				},

				//submit error
				resultError: function() {
					var resObj = arguments[0]
					var form = arguments[1]
					var msg = resObj['msg']
					$.toptip('操作失败', 'error')
					location.reload()
				}
			},
		}

		var selectRepairType = function() {
			var _select = $('input[name="select_repair_type"]')
			var _input = $('input[name="repair_type_id"]')
			var init_select = function(items) {
				_select.select({
					title: "选择维修设备",

					onChange: function() {
						var value = _select.attr('data-values')
						_input.val(value)
						$('#select_repair_type-error').remove()
					},

					items: items
				})
			}
			$.ajax({
				type:"get",
				url:"/api/repair-type/getSelectData",
				async:true,
			}).done(function(items) {
				init_select(items)
			})
		}
		
		var selectGrande = function() {
			var _select = $('input[name="select_grade"]')
			var _input = $('input[name="grade"]')
			var init_select = function(items) {
				_select.select({
					title: "选择紧急程度",

					onChange: function() {
						var value = _select.attr('data-values')
						_input.val(value)
						$('#select_grade-error').remove()
					},

					items: items
				})
			}
			$.ajax({
				type:"get",
				url:"/api/repair-order-grade/getSelectData",
				async:true,
			}).done(function(items) {
				init_select(items)
			})
		}
		return {
			init: function(pageName, page) {
				selectRepairType()
				selectGrande()
				App.form.validate(page, validate)
			}
		}
	})