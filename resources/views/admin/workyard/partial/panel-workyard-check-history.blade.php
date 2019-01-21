<div class="panel panel-info">
	<!-- Default panel contents -->
	<div class="panel-heading">
		<h3 class="panel-title">审核记录</h3>
	</div>
	@if(count($Workyard->checkWorkyardRecords))
	<!-- Table -->
	<table class="table">
		<thead>
			<tr>
				<th class="td-width-15">#</th>
				<th>审核结果</th>
				<th>备注</th>
				<th>审核时间</th>
				<th>审核人</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($Workyard->checkWorkyardRecords as $record)
			<tr>
				<td >{{ $loop->index + 1 }}</td>
				<td>
				@switch($record->status)
                    @case('CHECK_FAILED')
                        <span class="label label-danger"> 审核未通过 </span>
                        @break
                    @case('ENABLED')
                        <span class="label label-success"> 审核通过 </span>
                        @break
                @endswitch
				</td>
				<td>{{ $record->desc }}</td>
				<td>{{ $record->created_at }}</td>
				<td>{{ $record->checked_by }}</td>
			</tr>
            @endforeach
		</tbody>
	</table>
	@else
	<div class="panel-body">
        <p>未查到记录</p>
    </div>
	@endif
</div>