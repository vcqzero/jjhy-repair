define(
	['jquery', 'App', 'city-picker'],
	function($, App) {
		var validate = {

			'worker-add-info': {
				rules: {

					'address_area_info': {
						required: true,
					},

					'tel': {
						required: true,
						phone: true,
					},
					
					'realname': {
						required: true,
						maxlength: 10,
					},

					skill: {
						required: true,
						maxlength: 100,
					},
				},

				messages: {

					'address_area_info': {
						required: '请选择地区',
					},

					'tel': {
						required: '请输入手机号',
						phone: '请输入正确手机号',
					},

					realname: {
						required : '请输入真实姓名',
						maxlength: '最多10个字符',
					},
					
					skill: {
						required: '请输入技能信息，有利于接单',
						maxlength: '最多100字符',
					},
				},

				//submit success
				resultSuccess: function() {
					var resObj = arguments[0]
					var form = arguments[1]
					$.toptip('操作成功', 2000, 'success');  //设置显
					location = '/weixin/worker/add-certificate'
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
		return {
			init: function(pageName, page) {
				$('input[name="address_area_info"]').cityPicker({
					title: "请选择地区",
					onChange: function() {
						var _this = $(this)
						var codes = _this.attr('data-codes')
						$('input[name="address_area"]').val(codes)
						$('#address_area_info-error').remove()
					},
				});
				App.form.validate(page, validate)
			}
		}
	})