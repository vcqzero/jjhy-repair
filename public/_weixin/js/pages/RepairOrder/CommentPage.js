define(
	['jquery', 'App'],
	function($, App) {

		var validate = {
			'comment-form': {
				rules: {
					'comment_star': {
						required: true,
					},
				},

				messages: {

					'comment_star_select': {
						required: '请选择评价等级',
					},

				},

				//submit success
				resultSuccess: function() {
					var resObj = arguments[0]
					var form = arguments[1]
					$.toptip('操作成功', 2000, 'success'); //设置显
					location = '/weixin/repair-order/complete-order-success'
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

		var init_comment_star_select = function() {
			var _select = $('.select-comment-star')
			var _input = $('input[name="comment_star"]')
			var popup = $('#popup-submit-comment')
			_select.on('click', function() {
				popup.popup()
			})
			
			//当选择评价时
			$('input[name="comment-star"]').on('click', function() {
				$.closePopup()
				var _this = $(this)
				var comment_star = _this.val()
				var comment_star_html = _this.closest('.weui-cell').find('.weui-cell__bd').html()
				_select.find('.weui-cell__ft').html(comment_star_html)
				_input.val(comment_star)
			})
		}
		return {
			init: function(pageName, page) {
				init_comment_star_select()
				App.form.validate(page, validate)
			}
		}
	})