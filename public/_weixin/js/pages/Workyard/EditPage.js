define(
	['jquery', 'App', 'area', 'city-picker'],
	function($, App, area) {
		var validate = {

			'workyard-edit': {
				rules: {
					'name': {
						required: true,
						maxlength: 10,
						remote: {
							url: '/api/workyard/validName',
							data: { //要传递的数据
								id: function() {
									return $("#workyard_id").val();
								}
							}
						},
					},

					'address_area_info': {
						required: true,
						//						maxlength: 30,
					},

					'address_info': {
						required: true,
						maxlength: 30,
					},

					desc: {
						maxlength: 20,
					},
				},

				messages: {

					'name': {
						required: '请输入名称',
						maxlength: '最多10个字符',
						remote: '名称已占用，请更换',

					},

					'address_area_info': {
						required: '请选择地区',
						//						maxlength: 30,
					},

					'address_info': {
						required: '请输入具体地址',
						maxlength: '最多30个字符',
					},

					desc: {
						maxlength: '最多20个字符',
					},

				},

				//submit success
				resultSuccess: function() {
					var resObj = arguments[0]
					var form = arguments[1]
					$.toptip('操作成功', 2000, 'success'); //设置显
					location = '/weixin/account'
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

		var cityPicker = function() {
			var area_input = $('input[name="address_area"]')
			var area_info_input = $('input[name="address_area_info"]')
			var codes = area_input.val()
			var name = area.getName(codes)
			area_info_input.val(name)
			area_info_input.cityPicker({
				title: "请选择地区",
				onChange: function() {
					var _this = $(this)
					var codes = _this.attr('data-codes')
					area_input.val(codes)
					$('#address_area_info-error').remove()
				},
			});
		}
		return {
			init: function(pageName, page) {
				cityPicker()
				App.form.validate(page, validate)
			}
		}
	})