define(
	['jquery', 'App'],
	function($, App) {
		var validate = {

			'form-check': {
				errorPlacement: function(error, element) {
					var type = element.attr('type')
					if(type != 'radio') element.after(error)
					if(type == 'radio') element.parent().parent().before(error)
				},
				rules: {
					'status': {
						required: true,
					},

					desc: {
						maxlength: 30,
					},
				},

				messages: {
					'status': {
						required: '请审核 ',
					},

					desc: {
						maxlength: '最多30个字符',
					},
				},

				//submit success
				resultSuccess: function() {
					var resObj = arguments[0]
					var form = arguments[1]
					var modal = $('.modal')
					modal.modal('hide')
					var table = $('table')
					var bootstrap_table = $('.bootstrap-table')
					App.toastr('success', '操作成功')
					if(bootstrap_table.length > 0) {
						table.bootstrapTable('refresh');
					}else {
						location.reload()
					}
				},

				//submit error
				resultError: function() {
					var resObj = arguments[0]
					var form = arguments[1]
					var msg = resObj['msg']
					App.alert({
						container: form,
						place: 'prepend',
						type: 'danger',
						message: msg,
					})
				}
			},
		}
		return {
			init: function(pageName, page) {
				App.form.validate(page, validate)
			}
		}
	})