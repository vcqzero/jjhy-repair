define(
	['jquery', 'App'],
	function($, App) {
		var bootstrapTable = [{
			target : $('#users-list'),
			option : {
				url : '/api/user/workyard_admin',
				sortName : 'id',
//				toolbar : '.search',
				
				columns : [
					{
						valign : 'middle',
						checkbox : true,
					},
					{
						sortable :true,
						field: 'id',
                        valign : 'middle',
                    },
					{
						sortable :true,
						field: 'open_id',
						formatter : function(value, row, index, field) {
							var oauths = row.oauth
							var open_id
							for(var key in oauths) {
								var oauth = oauths[key]
								var type  = oauth['type']
								if(type == 'WEIXIN') open_id = oauth['open_id']
							}
							return open_id
						},
                        valign : 'middle',
                    },
					{
						sortable :true,
						field: 'username',
                        valign : 'middle',
                    },
					{
						sortable :true,
						field: 'workyard',
						formatter : function(value, row, index, field) {
							var workyard = row.workyard
							if (workyard) return workyard['name']
						},
                        valign : 'middle',
                    },
					{
						sortable :true,
						field: 'status',
                        valign : 'middle',
                    },
					
                    {
                        formatter : function(value, row, index, field) {
                        	var id   = row.id
                        	var view = '<a href="<?=$href?>"class="btn dark btn-sm btn-outline "> ' +
                        			'<i class="fa fa-share"></i> 查看</a>'
                        	var _delete = '<a href="<?=$href?>"class="btn red btn-sm btn-outline "> ' +
                        			'<i class="fa fa-trash-o"></i> 删除</a>'
                        	return view +  _delete;
                        },
                        valign : 'middle',
                    },
				],
			},
		}]
		return {
			init: function(pageName, page) {
//				App.table.init(page, tables)
				App.bootstrapTable(page, bootstrapTable)
			}
		}
	})