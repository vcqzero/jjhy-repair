define(
	['jquery', 'App', 'lrz', ],
	function($, App) {
		var gallery = $('.gallery-view')
		var gallery_img = $('.gallery-img')
		var btn_delete = $('.gallery-delete')
		var ul_view = $('#view-images')
		var shwo_success_msg = $('#show-success-msg')
		var complete_button = $('.btn-upload-complete')
		var count = 0
		var on_gallery_li
		var onFileChange = function() {
			var _input = $('input.upload-image')
			_input.on('change', function(e) {
				var _this = $(this)
				var _file = this.files[0]
				if(count >= 5) {
					$.alert('最多上传5张图片')
					return false;
				}
				
				//压缩图片 保证 2m以内
				lrz(_file, {
//					width: ,//宽度不超过640
					fieldName : 'certificate',//后端接受的文件名称
				}).then(function(rst) {
					console.log('rst.fileLen = ' + rst.fileLen / 1000 + 'kb')
					doAjax(rst)
				})
				
				_input.val('')
			})
			var appendImg = function(_url) {
				var li = $('<li class="weui-uploader__file"></li>')
				li.css('background-image', 'url(' + _url + ')')
				li.attr('data-url', _url)
				ul_view.append(li)
			}
			var doAjax = function(rst) {
				var url = '/api/worker/add-certificate'
				var oForm = rst.formData;
				var _token = $('input[name="_token"]').first().val()
//				oForm.append('certificate', file)
				oForm.append('_token', _token)
				$.ajax({
					type: "post",
					url: url,
					async: true,
					data: oForm,
					beforeSend: App.ajax.config.beforeSend,
//					error: App.ajax.config.error,
					//dataType: 'json',
					//async: false,
					processData: false,
					contentType: false,
				}).done(function(res) {
					$.hideLoading();
					var url = res.url
					appendImg(url)
					count++
					var span = $('#image-count')
					span.text(count)
				});
			}
		}

		var viewGallery = function() {
			ul_view.on('click', 'li', function() {
				var _li = $(this)
				on_gallery_li = _li
				gallery_img.css('background-image', _li.css('background-image'))
				gallery.removeClass('hidden')
			})
			gallery_img.on('click', function() {
				gallery.addClass('hidden')
			})
			btn_delete.on('click', function() {
				delete_img()
			})
		}

		var delete_img = function() {
			var _url = on_gallery_li.attr('data-url')
			var doAjax = function() {
				var url = '/api/worker/delete-certificate'
				var _token = $('input[name="_token"]').first().val()
				var data = {
					'_token': _token,
					'url': _url
				}
				$.ajax({
					type: "post",
					url: url,
					async: true,
					data: data,
					beforeSend: App.ajax.config.beforeSend,
					error: App.ajax.config.error,
				}).done(function(res) {
					$.hideLoading();
					gallery.addClass('hidden')
					on_gallery_li.remove()
					count = count - 1
					if(count < 1) shwo_success_msg.addClass('hidden')
				});
			}
			doAjax()
		}

		var upload_complete = function() {
			complete_button.on('click', function() {
				if(count < 1) {
					$.alert('至少上传1张报修单')
					return false;
				}
				location = location = '/weixin/worker/add-info-success'
			})
		}

		return {
			init: function(pageName, page) {
				onFileChange()
				viewGallery()
				upload_complete()
			}
		}
	})