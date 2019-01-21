<div class="panel panel-success">
	<!-- Default panel contents -->
	<div class="panel-heading">
		<h3 class="panel-title">基本信息</h3>
	</div>
	<!-- Table -->
	<table class="table">
		<tbody>
			<tr>
				<td class="td-width-15">ID</td>
				<td>{{ $Workyard->id }}</td>
			</tr>
			<tr>
				<td>项目名称</td>
				<td>{{ $Workyard->name }}</td>
			</tr>
			<tr>
				<td>所在地区</td>
				<td 
				class="show_address"
				data-codes="{{ $Workyard->province . ',' . $Workyard->city . ',' . $Workyard->district }}">   </td>
			</tr>
			<tr>
				<td>具体地址</td>
				<td> {{ $Workyard->address }}</td>
			</tr>
			<tr>
				<td>状态</td>
				<td>
				@switch($Workyard->status)
                    @case('WAIT_CHECK')
						<span class="label label-warning"> 等待审核 </span>
                        @break
                
                    @case('CHECK_FAILED')
                        <span class="label label-danger"> 审核未通过 </span>
                        @break
                    @case('ENABLED')
                        <span class="label label-success"> 正常 </span>
                        @break
                
                    @default
                        <span class="label label-default"> 已禁用 </span>
                @endswitch
				</td>
			</tr>
			<tr>
				<td>创建人</td>
				<td>{{ $Workyard->created_by }}</td>
			</tr>
			<tr>
				<td>创建时间</td>
				<td>{{ $Workyard->created_at }}</td>
			</tr>
			<tr>
				<td>管理员</td>
				<td>
				@foreach ($Workyard->users as $user)
					{{ $user->username }}
                @endforeach
				</td>
			</tr>
		</tbody>
	</table>
</div>
