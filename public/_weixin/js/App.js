/**
 * 框架文件
 * 不涉及模板
 * 
 */
define(function(require) {
	var $ = require('jquery')
	var jQuery = require('jquery')
	var pagePath = '/_weixin/js/pages/';
	var App = (function() {
		var handlePage = function() {
			var init_page = function(page) {
				var name = page.attr('data-name')
				var group = page.attr('data-group')
				var pageName
				if(typeof name == 'undefined' || typeof group == 'undefined') {
					console.log('未加载页面 ，页面名称未定义')
					return false;
				}
				pageName = pagePath + group + '/' + name + '.js'
				require([pageName], function(pageModule) {
					if(typeof pageModule == 'undefined') {
						return
					}
					if($.isFunction(pageModule['init'])) {
						pageModule.init(pageName, page)
					}
					console.log('加载页面完成：' + pageName)
				})
			}

			$(function() {
				var page = $('body').find('div.page').first()
				init_page(page)
			})
		}

		var handleTatbar = function() {
			var path = location.pathname
			var tarbar_a = $('.weui-tabbar').find('a')
			$.each(tarbar_a, function(k, v) {
				var _a = $(this)
				var href = _a.attr('href')
				if(path == href) _a.addClass('weui-bar__item--on')
			});
		}

		var handleTabEmpty = function() {
			var tabs = $('.show-empty')
			$.each(tabs, function(k, v) {
				var tab = $(this)
				if(tab.children().length < 1) {
					var empty = '<div class="weui-msg">' +
						'<div class="weui-msg__icon-area">' +
						'<i class="weui-icon-waiting weui-icon_msg"></i>' +
						'</div>' +
						'<div class="weui-msg__text-area">' +
						'<h2 class="weui-msg__title">没有内容</h2>' +
						'<p class="weui-msg__desc"></p>' +
						'</div>' +
						'</div>'
					tab.append(empty)
				}
			});
		}

		var androidInputBugFix = function() {
			// .container 设置了 overflow 属性, 导致 Android 手机下输入框获取焦点时, 输入法挡住输入框的 bug
			// 相关 issue: https://github.com/weui/weui/issues/15
			// 解决方法:
			// 0. .container 去掉 overflow 属性, 但此 demo 下会引发别的问题
			// 1. 参考 http://stackoverflow.com/questions/23757345/android-does-not-correctly-scroll-on-input-focus-if-not-body-element
			//    Android 手机下, input 或 textarea 元素聚焦时, 主动滚一把
			if(/Android/gi.test(navigator.userAgent)) {
				window.addEventListener('resize', function() {
					if(document.activeElement.tagName == 'INPUT' || document.activeElement.tagName == 'TEXTAREA') {
						window.setTimeout(function() {
							document.activeElement.scrollIntoViewIfNeeded();
						}, 0);
					}
				})
			}
		}

		return {
			init: function() {
				handlePage()
				handleTatbar()
				handleTabEmpty()
				androidInputBugFix()
			},
			ajax: {
				config: {
					beforeSend: function() {
						//						$.closePopup()
						$.showLoading("操作中");
					},
					error: function() {
						$.toast("操作失败", "forbidden", function() {
							//do something
							location.reload()
						});
					},
				},

				get: function(url, success, error) {
					$.ajax({
						type: "get",
						url: url,
						async: true,
						beforeSend: App.ajax.config.beforeSend,
						error: App.ajax.config.error

					}).done(function(res) {
						$.hideLoading();
						$.toast.prototype.defaults.duration = 500
						if(res) {
							$.toast("操作成功", "success", function() {
								//do something
								if($.isFunction(success)) {
									success()
									return
								}
								location.reload()
							});
						} else {
							$.toast("操作失败", "forbidden", function() {
								//do something
								if($.isFunction(error)) {
									error()
									return
								}
								location.reload()
							});
						}
					})
				},

				post: function(url, data, success, error) {
					data['_token'] = $('input[name="_token"]').first().val()
					$.ajax({
						type: "post",
						url: url,
						data: data,
						async: true,
						beforeSend: App.ajax.config.beforeSend,
						error: App.ajax.config.error

					}).done(function(res) {
						$.hideLoading();
						$.toast.prototype.defaults.duration = 500
						if(res.success) {
							$.toast("操作成功", "success", function() {
								//do something
								if($.isFunction(success)) {
									success()
									return
								}
								location.reload()
							});
						} else {
							$.toast("操作失败", "forbidden", function() {
								//do something
								if($.isFunction(error)) {
									error()
									return
								}
								location.reload()
							});
						}
					})
				},
			},
			pullToRefresh: function($target, placeholder) {
				var dom = '<div class="weui-pull-to-refresh__layer">' +
					'<div class="weui-pull-to-refresh__arrow"></div>' +
					'<div class="weui-pull-to-refresh__preloader"></div>' +
					'<div class="down">下拉刷新</div>' +
					'<div class="up">释放刷新</div>' +
					'<div class="refresh">正在刷新</div>' +
					'</div>'
				var placeholderDiv = '<div class="placeholder"></div>'
				$target.prepend(dom)
				if(placeholder != false) $target.append(placeholderDiv)
				$target.css('width', '100%')
				$target.pullToRefresh(function() {
					location.reload()
				});
			},

			infinite: {
				init: function(options) {
					var $target = options['target']
					var url = options['url']
					var container = options['container']
					var search = options['search']
					var callback = options['callback']
					var dom = '<div class="weui-loadmore hidden">' +
						'<i class="weui-loading"></i>' +
						'<span class="weui-loadmore__tips">正在加载</span>' +
						'</div>'
					$target.append(dom)
					$target.infinite();
					$target.infinite().on("infinite", function() {
						$target.find('.weui-loadmore').removeClass('hidden')
					})
					App.infinite.paginator($target, url, container, search, callback)
				},

				paginator: function($target, url, container, search, callback) {
					var loading = false; //状态标记
					$target.infinite().on("infinite", function() {
						if(loading) return
						var last = $target.find('.paginator-cell').last()
						var hasMore = last.attr('data-page-has-more-pages') == 'yes'
						var current_page = last.attr('data-page-current-page')
						var next_page = parseInt(current_page) + 1
						var _url
						_url = url + '?page=' + next_page + '&' + search
						if(hasMore != true) {
							App.infinite.destory($target)
							return false;
						}
						$.ajax({
							type: "get",
							url: _url,
							async: true,
							beforeSend: function() {
								loading = true
							}
						}).done(function(html) {
							loading = false
							if(container.length < 1) {
								throw new Error('未提供正确的container')
							}
							container.append(html)
							if($.isFunction(callback)) callback()
						})
					});
				},

				destory: function($target) {
					var dom = '<div class="weui-loadmore weui-loadmore_line">' +
						'<span class="weui-loadmore__tips">加载全部</span>' +
						'</div>'
					$target.find('.weui-loadmore').replaceWith(dom)
					$target.destroyInfinite()
				},

			},

			form: {
				doAjaxSubmit: function(form) {
					var EVENT_COMPLETE = 'form-ajax-submit:done'

					var getActionUrl = function(form) {
						return form.attr('action')
					}

					var doSubmit = function(form) {
						var url = getActionUrl(form)
						var data = form.serialize()
						var _token = $('input[name="_token"]').first().val()
						data = data + '&_token=' + _token
						$.ajax({
							type: "post",
							data: data,
							dataType: 'json',
							url: url,
							async: true,
							beforeSend: function() {
								loadingButton(form, true)
								$.showLoading("操作中");
							},
							error: App.ajax.config.error,

						}).done(function(resObj) {
							$.hideLoading();
							//将按钮设置为非加载状态
							loadingButton(form, false)
							form.trigger(EVENT_COMPLETE, {
								'resObj': resObj
							})
						});
					}

					var loadingButton = function(form, loading) {
						var submitButton = form.find('button[type="submit"]')
						submitButton.prop('disabled', loading === true)
						var test = loading ? '处理中...' : '提交保存'
						submitButton.text(test)
					}

					doSubmit(form)
				},

				validate: function(page, config) {
					require(['jqueryValidate'], function() {
						addMethod()
						for(var form_id in config) {
							var _option = config[form_id]
							var form = $('#' + form_id)
							if(form.length < 1) {
								return false
							}
							var option = getOption(_option)
							form.validate(option)
							//将默认的ajax submit监听去掉
							form.attr('data-igonre', 'ignore')
							//将submit按钮enable
							form.find('button').prop('disabled', false)

							//自动增加submit的result
							initResultSumit(page, config)
						}
					})

					var getOption = function(_option) {
						var option = {
							debug: false,
							onsubmit: true, //当点击submit时进行验证
							onfocusout: function(element) {
								$(element).valid();
							},
							//对应input元素，当失去焦点时进行验证
							onkeyup: function(element) {
								$(element).valid();
							},
							//当键盘按键按下
							onclick: false,
							focusInvalid: false, // 
							focusCleanup: true, // clean error on focus
							errorElement: 'div', //default input error message container
							errorClass: 'weui-cells__tips help-block-error', // default input error message class
							ignore: ":hidden", // validate all fields including form hidden input

							invalidHandler: function(event, validator) { //display error alert on form submit
								//当验证错误时触发此动作
							},

							highlight: function(element) { // hightlight error inputs
								//								$(element).closest('.form-group').removeClass("has-success").addClass('has-error'); // set error class to the control group   
							},

							unhighlight: function(element) { // revert the change done by hightlight
								//								$(element).closest('.form-group').removeClass('has-error');
							},

							success: function(label, element) {},

							submitHandler: function(form) {
								App.form.doAjaxSubmit($(form))
							},
							errorPlacement: function(error, element) {
								var cell = $(element).closest('.weui-cell')
								cell.after(error)
							},
						}

						$.extend(true, option, _option)
						return option
					}

					var initResultSumit = function(page, config) {
						App.form.submitResult(page, config)
					}

					var addMethod = function() {

						jQuery.validator.addMethod("phone", function(value, element, param) {
							var reg = /^[1][3,4,5,6,7,8,9][0-9]{9}$/
							var res = reg.test(value)
							return this.optional(element) || res;
						}, $.validator.format("请输入正确手机号"));

						jQuery.validator.addMethod("username", function(value, element, param) {
							var reg = /^[a-zA-Z]{1}([a-zA-Z0-9]|[._-]){3,19}$/
							var res = reg.test(value)
							return this.optional(element) || res;
						}, $.validator.format("字母开头，可包含（._-），4~20个字符"));

						jQuery.validator.addMethod("myPassword", function(value, element, param) {
							var reg = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[^]{6,100}$/
							var res = reg.test(value)
							return this.optional(element) || res;
						}, $.validator.format("至少6个字符，至少1个大写字母，1个小写字母和1个数字"));

						jQuery.validator.addMethod("differ", function(value, element, param) {
							var selector = param
							var _value = $(selector).val()
							return this.optional(element) || _value != value;
						}, $.validator.format("输入内容必须和{0}不同"));

					}
				},

				submitResult: function(page, config) {
					var isModal = function(page) {
						return page.hasClass('modal')
					}

					var doResult = function(resObj, _config, form) {
						var success = resObj['success']
						var callback
						if(success) {
							callback = _config['resultSuccess']
						} else {
							callback = _config['resultError']
						}
						if($.isFunction(callback)) {
							callback(resObj, form)
							return
						}
					}

					$('body').off('form-ajax-submit:done', 'form')
					$('body').on('form-ajax-submit:done', 'form', function(e) {
						var resObj = arguments[1]['resObj']
						var form = $(e.currentTarget)
						var form_id = form.attr('id')
						var _config = config[form_id]
						if(_config) {
							doResult(resObj, _config, form)
						} else {
							console.log('ERROR 未找到表单提交之后执行的配置文件信息，请确保已配置')
						}
						return
					})
				},

				getSerialize: function(form) {
					var queryArray = form.serializeArray()
					var queryStr = []
					$.each(queryArray, function(k, query) {
						var name = query['name']
						var value = query['value']
						if(value) {
							queryStr.push(name + '=' + value)
						}
					});
					queryStr = queryStr.join('&')
					return queryStr
				},

			},

			modalMask: function(show) {
				var dom = '<div class="weui-mask weui-mask--visible"></div>'
				if(show) {
					$('body').append(dom)
				} else {
					$('.weui-mask').remove()
				}
			},
		}
	})()
	return App
})