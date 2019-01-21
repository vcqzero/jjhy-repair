define(
	['jquery', 'App'],
	function($, App) {
		var editableConfig = [
			//admin
			{
				target: $('.edit-settings-check'),
				option: {
					url: '/api/settings/edit',
//					value: getValueCheck(),
					source: [
						{
							value: 'yes',
							text: '需要审核'
						},
						{
							value: 'no',
							text: '不需要审核'
						},
					]
				},
			},
			{
				target: $('.edit-settings-offer'),
				option: {
					url: '/api/settings/edit',
//					value: getValueCheck(),
					source: [
						{
							value: 'yes',
							text: '可以抢单，可以派单',
						},
						{
							value: 'no',
							text: '不可抢单，仅能管理员派单',
						},
					]
				},
			},
			{
				target: $('.edit-settings-offer-price'),
				option: {
					url: '/api/settings/edit',
//					value: getValueCheck(),
					source: [
						{
							value: 'yes',
							text: '可以填写价格',
						},
						{
							value: 'no',
							text: '不可填写价格',
						},
					]
				},
			},
		]

		return {
			init: function(pageName, page) {
				App.editable(page, editableConfig)
			}
		}
	})