<!-- 展示报价信息 -->
@if($repairOrder->offer->id > 0))
<tr>
	<td>类型</td>
	<td>抢单</td>
</tr>
<tr>
	<td>报价</td>
	<td>{{ $repairOrder->offer->price }}（￥）</td>
</tr>
<tr>
	<td>报价工期</td>
	<td>{{ $repairOrder->offer->days }}（天）</td>
</tr>
@else
<tr>
	<td>类型</td>
	<td>管理员分配维修工程师</td>
</tr>
<tr>
	<td>报价</td>
	<td>无报价</td>
</tr>
@endif
