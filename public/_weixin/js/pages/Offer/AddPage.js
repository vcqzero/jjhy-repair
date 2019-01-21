define(
	['jquery', 'App'],
	function($, App) {
		var validate = {

			'offer-add': {
				rules: {
					'price': {
						required: true,
						number: true,
						min : 0.01,
					},

					'days': {
						required: true,
						number: true,
					},
				},

				messages: {

					'price': {
						required: '请输入报价',
						number: '请输入正确价格',
						min : '价格不能小于0.01',
					},

					'days': {
						required: '请输入天数',
						number: '请输入天数',
					},

				},

				//submit success
				resultSuccess: function() {
					var resObj = arguments[0]
					var form = arguments[1]
//					$.toptip('操作成功', 2000, 'success'); //设置显
					location = '/weixin/offer/success'
				},

				//submit error
				resultError: function() {
					var resObj = arguments[0]
					var form = arguments[1]
					var msg = resObj['msg']
					$.toptip('操作失败', 'error')
//					location.reload()
				}
			},
		}
		
		return {
			init: function(pageName, page) {
				App.form.validate(page, validate)
			}
		}
	})