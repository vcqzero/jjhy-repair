define(
	['jquery', 'App', 'area'],
	function($, App, area) {
		var showAddress = function(page) {
			var td = page.find('.show_address')
			var codes = td.attr('data-codes')
			var address = area.getName(codes)
			td.text(address)
		}
		return {
			init: function(pageName, page) {
				showAddress(page)
			}
		}
	})