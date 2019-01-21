define(
	['jquery', 'App', 'area'],
	function($, App, area) {
		var showAddress = function(page) {
			var tds = page.find('.show_address')
			$.each(tds, function(k, v) {
				var td = $(this)
				var codes = td.attr('data-codes')
				var address = area.getName(codes)
				td.text(address)
			});

		}
		return {
			init: function(pageName, page) {
				showAddress(page)
			}
		}
	})