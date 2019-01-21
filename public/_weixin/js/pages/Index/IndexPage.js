define(
	['jquery', 'App', 'area', 'city-picker'],
	function($, App, area) {
		var search = {
			init: function() {
				var showClass = 'show'
				var li = $('li.search')
				$('.search-bar').on('click', function() {
					var show = li.hasClass(showClass)
					search.toggleSearch(show)
					li.toggleClass(showClass)
				})

				$('#repair-order-container').on('click', function() {
					var show = li.hasClass(showClass)
					if(show) search.toggleSearch(show)
					li.toggleClass(showClass)
				})

				search.cityPicker()
				search.selectRepairType()
			},

			/**
			 * 打开或关闭搜索
			 * 
			 * @param {Object} show 当前状态
			 */
			toggleSearch: function(show) {
				var icon = $('span.search-icon i')
				var _content = $('.js_categoryInner')
				var _select = $('input[name="repair_type_name"]')
				if(show) {
					//隐藏搜索
					icon.attr('class', 'fa fa-angle-down')
					_content.fadeOut(200)
					//关闭选择维修项目
					_select.select("close")
				} else {
					//显示搜索
					icon.attr('class', 'fa fa-angle-up')
					_content.fadeIn(200)
				}
			},

			cityPicker: function() {
				var area_input = $('input[name="address_area"]')
				var area_info_input = $('input[name="address_area_name"]')
				var codes = area_input.val()
				var address_area = area.getName(codes)
				var city = area.getName(codes, 1)
				$('span.search-address-area').text('地区：' + city)
				area_info_input.val(address_area)
				area_info_input.cityPicker({
					showDistrict: false,
					title: "请选择地区",
					onChange: function() {
						var _this = $(this)
						var codes = _this.attr('data-codes')
						area_input.val(codes)
					},
				});
			},

			selectRepairType: function() {
				var _select = $('input[name="repair_type_name"]')
				var _input = $('input[name="repair_type_id"]')
				var init_select = function(items) {
					_select.select({
						title: "选择维修项目",

						onChange: function() {
							var value = _select.attr('data-values')
							_input.val(value)
						},

						items: items
					})
				}
				$.ajax({
					type: "get",
					url: "/api/repair-type/getSelectData",
					async: true,
				}).done(function(items) {
					init_select(items)
				})
			},

			initContent: function() {

			},
		}

		var repair_order_list = {
			view: function() {
				$('body').on('click', 'a.view-repair-order', function() {
					var _a = $(this)
					var order_id = _a.attr('data-order-id')
					var url = '/weixin/repair-order/worker-view/' + order_id
					$.ajax({
						type: "get",
						url: url,
						async: true,
						beforeSend: function() {
							$.showLoading("操作中");
						},
					}).done(function(content) {
						$.hideLoading("操作中");
						var popup = $('#popup-offer-manage')
						popup.find('.popup_container').replaceWith(content)
						popup.popup()
						repair_order_list.init_preview(popup)
					})
				})
			},

			init_preview: function(popup) {
				var show_area = function() {
					var priview = popup.find('div.popup-show-address-area')
					var codes = priview.attr('data-codes')
					var address_area_name = area.getName(codes)
					priview.find('.weui-form-preview__value').text(address_area_name)

				}

				var contact_user = function() {
					popup.find('a.preview-contact').on('click', function() {

					})
				}
				show_area()
				contact_user()
			},

			showAddress: function() {
				var lis = $('body').find('li.address_area')
				if(lis.length < 1) return
				$.each(lis, function(k, v) {
					var li = $(this)
					var codes = li.attr('data-codes')
					var name = area.getName(codes)
					li.find('.address_area_name').text(name)
				});
			},

			infinite: function() {
				var options = {
					target: $('#tab-repair-order-container'),
					container: $('#repair-order-container'),
					url: '/weixin/index',
					search: location.search,
					callback: function() {
						repair_order_list.showAddress()
					}
				}
				App.infinite.init(options)
			}
		}

		var static_search = function() {
			var form = $('#index_search')
			var static_class = 'index-form-search'
			$('#tab-repair-order-container').scroll(function() {
				var sctop = $(this).scrollTop()
				sctop = parseInt(sctop)
				if(sctop > 50) {
					form.addClass(static_class)
				} else {
					form.removeClass(static_class)
				}
			})
		}

		//进行接单处理
		var take_repair_order = function() {
			var do_ajax = function(repair_order_id) {
				var url = '/api/repair-order/take-order/' + repair_order_id
				var success = function() {
					//接单成功进入我的维修页面
					location = '/weixin/repair-order/take-order-success'
				}
				App.ajax.get(url, success)
			}
			$('body').on('click', '.btn-do-offer', function() {
				var _this = $(this)
				var repair_order_id = _this.attr('data-repair-order-id')
				//直接进行接单
				$.confirm({
					title: '确认接单？',
					text: '接单成功之后开始设备维修工作',
					onOK: function() {
						//点击确认
						do_ajax(repair_order_id)
					},
					onCancel: function() {}
				});
			})
		}

		return {
			init: function(pageName, page) {
				App.pullToRefresh($('#tab-repair-order-container'), false)
				search.init()
				repair_order_list.showAddress()
				repair_order_list.view()
				repair_order_list.infinite()
				static_search()
				take_repair_order()
			}
		}
	})