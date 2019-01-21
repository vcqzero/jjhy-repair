define(
	['jquery', 'App'],
	function($, App) {
		var validate = {

			'form_distribute': {

				rules: {
					worker_id : {
						required: true,
					}
				},

				messages: {
					worker_id : {
						required: '请选择维修工',
					}
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