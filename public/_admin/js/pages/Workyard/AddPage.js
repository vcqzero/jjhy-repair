define(
	['jquery', 'App', 'pickArear'],
	function($, App) {
		var validate = {

			'form-add': {
				ignore : '',
				rules: {
					'name': {
						required: true,
						maxlength: 10,
						remote: '/api/workyard/validName',

					},

					'address_area': {
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
					
					'address_area': {
						required: '请输入具体地址',
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
					var modal = $('.modal')
					modal.modal('hide')
					var table = $('#workyards-enabled')
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

		var pickArear = function() {
			var a = $('.pick-area');
			$('.pick-area').pickArea({
				"getVal": function() {
//					var thisdom = $("." + $(".pick-area-dom").val());
				}
			})
			a.css('width', '100%')
			a.find('input.pick-area').attr('name', 'address_area')
		}
		return {
			init: function(pageName, page) {
				App.form.validate(page, validate)
				pickArear()
			}
		}
	})