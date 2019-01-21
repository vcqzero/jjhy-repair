<div class="panel panel-success">
	<!-- Default panel contents -->
	<div class="panel-heading">
		<h3 class="panel-title">保险单</h3>
	</div>
	<!-- Table -->
	<table class="table">
		<tbody>
			@foreach($worker->certificates as $certificate)
			<tr>
				<td class="td-width-10">{{ $loop->iteration }}</td>
				<td>
				<a href="{{ $certificate->url }}"
				target="_blank"
				class="thumbnail" style="width: 300px">
                  <img src="{{ $certificate->url }}" alt="保险单照片">
                </a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
