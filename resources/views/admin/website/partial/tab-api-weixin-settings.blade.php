<div class="tab-pane" id="tab-api-weixin-settings">

<button
class="btn green btn-outline btn-select-file test-weixin"
style="margin-bottom: 10px"
>
<span>
<i class="fa fa-location-arrow"></i> 测试微信</span>
</button>
<table class="table table-bordered table-striped">
	<tbody>
		<tr>
			<td style="width: 20%">微信公众号</td>
			<td style="width: 80%">
			{{ $weixin['name'] }}
			</td>
		</tr>
		<tr>
			<td style="width: 20%">appID</td>
			<td style="width: 80%">
			{{ $weixin['appid'] }}
			</td>
		</tr>
		<tr>
			<td>appsecret</td>
			<td>
			*******
			</td>
		</tr>
	</tbody>
</table>
</div>