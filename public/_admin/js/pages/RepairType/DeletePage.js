define(
	['jquery', 'App'],
	function($, App) {
		var validate = {

			'form-delete-item-type': {

				rules: {
				},

				messages: {
				},

				//submit success
				resultSuccess: function() {
					var resObj = arguments[0]
					var form = arguments[1]
					var modal = $('.modal')
					modal.modal('hide')
					var table = $('#item-types')
					table.bootstrapTable('refresh');
					App.toastr('success', '操作成功')
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