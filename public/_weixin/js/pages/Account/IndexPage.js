define(
	['jquery', 'App', 'area', 'swiper'],
	function($, App, area) {

		var changeRole = function() {

			$('#account-change-role').on('click', function() {
				var role = $(this).attr('data-role')
				$.confirm({
					title: '切换身份',
					text: role == 'WORKER' ? '切换到项目管理员，可发布维修信息' : '切换到维修工',
					onOK: function() {
						var url = '/api/account/change-role'
						App.ajax.get(url)
					},
					onCancel: function() {}
				});
			})
		}

		var createRole = function() {
			var _input = $('input[name="select_role"]')
			if(_input.length < 1) return
			$.alert('请先选择角色')

			$('.create-role').on('click', function() {
				var role = $(this).val()
				var url = '/api/account/create-role/' + role
				App.ajax.get(url)
			})

		}

		var showArea = function() {
			var divs = $('div.area-codes')
			if(divs.length < 1) return
			$.each(divs, function(k, v) {
				var div = $(this)
				var codes = div.attr('data-codes')
				var name = area.getName(codes)
				div.text(name)
			});
		}

		var exchangeWorkyard = function() {
			$('body').on('click', 'input.exchange-workyard', function() {
				var _this = $(this)
				var workyard_id = _this.val()

				var url = '/api/account/edit'
				var data = {
					name: 'workyard_id',
					value: workyard_id,
				}
				App.ajax.post(url, data)
			})
		}

		var swiper = function() {
			var cell_view = $('.cell-view-certificate')
			var pb
			if(cell_view.length < 1) return false;
			$.ajax({
				type: "get",
				url: "/weixin/worker/view-certificate",
				async: true
			}).done(function(data) {
				var certificates = data['certificates']
				var items = []
				for (var key in certificates) {
					var certificate = certificates[key]
					var url = certificate['url']
					items.push(url)
				}
				pb = $.photoBrowser({
					items: items
				})
			})
			cell_view.on('click', function() {
				pb.open()
			})
		}

		return {
			init: function(pageName, page) {
				changeRole()
				createRole()
				showArea()
				exchangeWorkyard()
				swiper()
			}
		}
	})