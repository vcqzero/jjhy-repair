define(
	['jquery', 'App'],
	function($, App) {
		var wait_confirm = {
			offer_manage: function() {
				var offer_id

				var open_actions = function() {
					$.actions({
						'title': '管理报价',
						actions: [{
								text: "修改报价",
								className: 'text-primary',
								onClick: function() {
									var url = '/weixin/offer/edit/' + offer_id
									location = url
								}
							},
							{
								text: "取消报价",
								className: 'text-danger',
								onClick: function() {
									$.confirm({
										title: '取消报价？',
										//					text: '',
										onOK: function() {
											var url = '/api/offer/cancel/' + offer_id
											App.ajax.get(url)
										},
										onCancel: function() {}
									});

								}
							}
						]
					});
				}

				$('.offer-manager').on('click', function() {
					var _this = $(this)
					offer_id = _this.attr('data-offer-id')
					open_actions()
				})
			},
		}

		var show_count_badge = function() {

			var count_offering = $('.count-offering').text()

			if(count_offering) {
				var badge = '<span class="weui-badge" style="margin-left: 5px; margin-bottom: 5px;">' + count_offering + ' </span> '
				$('.badge-count-offering').append(badge)
			}

			var count_working = $('.preview-on-working').length
			if(count_working) {
				var badge = '<span class="weui-badge" style="margin-left: 5px; margin-bottom: 5px;">' + count_working + ' </span> '
				$('.badge-count-working').append(badge)
			}
		}

		var completed = {
			infinite: function() {
				var options = {
					target: $('#repair_order_list_completed'),
					container: $('div.repair_order_list_completed_container'),
					url: '/weixin/offer/paginateCompleted',
				}
				App.infinite.init(options)
			}
		}

		var closed = {
			infinite: function() {
				var options = {
					target: $('#repair_order_list_failed'),
					container: $('div.repair_order_list_failed_container'),
					url: '/weixin/offer/paginateFailed',
				}
				App.infinite.init(options)
			}
		}

		return {
			init: function(pageName, page) {
				App.pullToRefresh($('#repair_order_list_offering'))
				show_count_badge()
				//wait_confirm
				wait_confirm.offer_manage()

				//completed
				completed.infinite()
				closed.infinite()
			}
		}
	})