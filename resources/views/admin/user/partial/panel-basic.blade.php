<div class="panel panel-success">
	<!-- Default panel contents -->
	<div class="panel-heading">
		<h3 class="panel-title">基本信息</h3>
	</div>
	<!-- Table -->
	<table class="table">
		<tbody>
			<tr>
				<td class="td-width-10">ID</td>
				<td>{{ $user->id }}</td>
			</tr>
			<tr>
				<td>用户名</td>
				<td>{{ $user->username }}</td>
			</tr>
			
			<tr>
				<td>真实姓名</td>
				<td>{{ $user->realname }}</td>
			</tr>
			
			<tr>
				<td>手机号</td>
				<td>{{ $user->tel }}</td>
			</tr>
			
			<tr>
				<td>所在地区</td>
				<td 
				class="show_address"
				data-codes="{{ $user->province . ',' . $user->city . ',' . $user->district }}">   </td>
			</tr>
			<tr>
				<td>创建时间</td>
				<td>{{ $user->created_at }}</td>
			</tr>
		</tbody>
	</table>
</div>
