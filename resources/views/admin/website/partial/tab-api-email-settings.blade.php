<div class="tab-pane active" id="tab-api-email-settings">
<button
class="btn green btn-outline btn-select-file send-test-email"
style="margin-bottom: 10px"
>
<span>
<i class="fa fa-location-arrow"></i> 发送测试邮件</span>
</button>

<table class="table table-bordered table-striped">
	<tbody>
		<tr>
			<td style="width: 20%">主机地址</td>
			<td>
			{{ $mail['host'] }}
			</td>
		</tr>
		<tr>
			<td>端口</td>
			<td>
			{{ $mail['port'] }}
			</td>
		</tr>
		<tr>
			<td>账户名称</td>
			<td>
			{{ $mail['username'] }}
			</td>
		</tr>
		<tr>
			<td>密码</td>
			<td>
			******
			</td>
		</tr>
	</tbody>
</table>
</div>
