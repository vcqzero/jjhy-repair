define(
	['jquery', 'App'],
	function($, App) {
		var wait_worker = {
			repair_order_manage: function() {
				$('a.repair-order-manager').on('click', function() {
					var _this = $(this)
					var repair_id = _this.attr('data-repair-order-id')
					var url_edit = '/weixin/repair-order/edit/' + repair_id
					var url_close = '/api/repair-order/close/' + repair_id
					console.log(url_edit)
					$.actions({
						'title': '管理维修单',
						actions: [{
								text: "编辑",
								className: 'text-warning',
								onClick: function() {
									//do something
									location = url_edit
								}
							},
							{
								text: "取消维修",
								className: 'text-danger',
								onClick: function() {
									$.confirm({
										title: '取消维修单',
										text: '取消该维修单',
										onOK: function() {
											//点击确认
											App.ajax.get(url_close)
										},
										onCancel: function() {}
									});
								}
							}
						]
					});
				})
			},

			open_offer_popup: function() {
				$('a.repair-order-offer').on('click', function() {
					var _this = $(this)
					var container = _this.closest('div.repair-order-container')
					var popup = container.find('div.weui-popup__container')
					popup.popup()
				})
			},

			offer_manage: function() {
				var offer_id
				var repair_order_id
				var on_action_agree = function() {
					$.confirm({
						title: '同意接单？',
						text: '将指定该维修工进行维修',
						onOK: function() {
							//点击确认
							var url = '/api/offer/confirm/' + offer_id + '/' + repair_order_id
							App.ajax.get(url)
						},
						onCancel: function() {}
					});
				}
				var on_action_refuse = function() {
					$.confirm({
						title: '拒绝接单？',
						//					text: '',
						onOK: function() {
							var url = '/api/offer/refuse/' + offer_id
							App.ajax.get(url)
						},
						onCancel: function() {}
					});

				}

				var open_actions = function() {
					$.actions({
						'title': '管理接单',
						actions: [{
								text: "同意接单",
								className: 'text-primary',
								onClick: on_action_agree
							},
							{
								text: "拒绝接单",
								className: 'text-danger',
								onClick: on_action_refuse
							}
						]
					});
				}

				$('.offer-manager').on('click', function() {
					var _this = $(this)
					offer_id = _this.attr('data-offer-id')
					repair_order_id = _this.attr('data-repair-order-id')
					open_actions()
					//				var url_edit = '/weixin/repair-order/edit/' + repair_id
					//				var url_close = '/api/repair-order/close/' + repair_id

				})
			},
		}

		var working = function() {
			var repair_order_id
			var url = '/api/repair-order/complete'
			var popup = $('#popup-submit-comment')

			var do_ajax = function(comment_star) {
				var _url = url + '/' + repair_order_id + '?comment_star=' + comment_star
				var success = function() {
					//接单成功进入我的维修页面
					location = '/weixin/repair-order/complete-order-success'
				}
				App.ajax.get(_url, success)
			}

			//当选择评价时
			$('input[name="comment-star"]').on('click', function() {
				$.closePopup()
				var _this = $(this)
				var comment_star = _this.val()
				$.confirm({
					title: '维修完成？',
					text: '您的评价为' + comment_star + '星',
					onOK: function() {
						//点击确认
						do_ajax(comment_star)
					},
					onCancel: function() {}
				});
			})

			$('.repair_complete').on('click', function() {
				var _this = $(this)
				repair_order_id = _this.attr('data-repair-order-id')
				repair_order_id = repair_order_id
				popup.popup()
			})
		}

		var show_count_badge = function() {

			var count_wait_worker = $('.count-wait-worker').text()
			if(count_wait_worker) {
				var badge = '<span class="weui-badge" style="margin-left: 5px; margin-bottom: 5px;">' + count_wait_worker + ' </span> '
				$('.badge-count-wait-worker').append(badge)
			}
			var count_working = $('.count-working').text()
			if(count_working) {
				var badge = '<span class="weui-badge" style="margin-left: 5px; margin-bottom: 5px;">' + count_working + ' </span> '
				$('.badge-count-working').append(badge)
			}
		}

		var complete = {
			infinite: function() {
				var options = {
					target: $('#repair_order_list_completed'),
					container: $('div.repair_order_list_completed_container'),
					url: '/weixin/repair-order/paginateCompleted',
					//					search: location.search,
				}
				App.infinite.init(options)
			}
		}

		var closed = {
			infinite: function() {
				var options = {
					target: $('#repair_order_list_closed'),
					container: $('div.repair_order_list_closed_container'),
					url: '/weixin/repair-order/paginateClosed',
				}
				App.infinite.init(options)
			}
		}

		return {
			init: function(pageName, page) {
				App.pullToRefresh($('#repair_order_list_wait_worker'))
				show_count_badge()
				//wait_worker
				wait_worker.repair_order_manage()
				wait_worker.open_offer_popup()
				wait_worker.offer_manage()
				//working
				working()
				//complete
				complete.infinite()
				//closed
				closed.infinite()
			}
		}
	})