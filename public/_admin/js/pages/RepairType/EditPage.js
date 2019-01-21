define(
	['jquery', 'App'],
	function($, App) {
		var validate = {

			'form-edit-item-type': {

				rules: {
					'name': {
						required: true,
						maxlength: 10,
						remote: {
							url: '/api/repair-type/validName',
							data: { //要传递的数据
								id: function() {
									return $("#form-edit-id").val();
								}
							}
						},

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

					desc: {
						maxlength: '最多20个字符',
					},
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