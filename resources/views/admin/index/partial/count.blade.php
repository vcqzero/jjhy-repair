<?php 
use App\Model\Workyard;
use App\Model\RepairOrder;

$workyard_count = Workyard::query()->count();
$workers_full_time_count = \App\Model\User::query()->whereHas('roles_on_owning', function($query) {
    $query->where('name', 'WORKER')->where('role_user.worker_type', 'FULL_TIME');
})->count();
$workers_part_time_count = \App\Model\User::query()->whereHas('roles_on_owning', function($query) {
    $query->where('name', 'WORKER')->where('role_user.worker_type', 'PART_TIME');
})->count();

//所有维修单数量
$repair_order_count = RepairOrder::query()->count();
?>
<div class="row widget-row">
	<!-- 项目统计 -->
	<div class="col-md-3">
		<!-- BEGIN WIDGET THUMB -->
		<div
			class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
			<h4 class="widget-thumb-heading">所有项目</h4>
			<div class="widget-thumb-wrap">
				<i class="widget-thumb-icon bg-green fa fa-road"></i>
				<div class="widget-thumb-body">
					<span class="widget-thumb-subtitle">总计（个）</span> 
					<span
						class="widget-thumb-body-stat" data-counter="counterup"
						data-value="7,644">{{ $workyard_count }}</span>
				</div>
			</div>
		</div>
		<!-- END WIDGET THUMB -->
	</div>
	
	<div class="col-md-3">
		<!-- BEGIN WIDGET THUMB -->
		<div
			class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
			<h4 class="widget-thumb-heading">全职维修工程师</h4>
			<div class="widget-thumb-wrap">
				<i class="widget-thumb-icon bg-blue-madison fa fa-user"></i>
				<div class="widget-thumb-body">
					<span class="widget-thumb-subtitle">总计（人）</span> <span
						class="widget-thumb-body-stat" data-counter="counterup"
						data-value="1,293">{{ $workers_full_time_count }}</span>
				</div>
			</div>
		</div>
		<!-- END WIDGET THUMB -->
	</div>
	<div class="col-md-3">
		<!-- BEGIN WIDGET THUMB -->
		<div
			class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
			<h4 class="widget-thumb-heading">兼职维修工程师</h4>
			<div class="widget-thumb-wrap">
				<i class="widget-thumb-icon bg-purple fa fa-user"></i>
				<div class="widget-thumb-body">
					<span class="widget-thumb-subtitle">总计（人）</span> <span
						class="widget-thumb-body-stat" data-counter="counterup"
						data-value="815">{{ $workers_part_time_count }}</span>
				</div>
			</div>
		</div>
		<!-- END WIDGET THUMB -->
	</div>
	<div class="col-md-3">
		<!-- BEGIN WIDGET THUMB -->
		<div
			class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
			<h4 class="widget-thumb-heading">所有维修单</h4>
			<div class="widget-thumb-wrap">
				<i class="widget-thumb-icon bg-blue icon-bar-chart"></i>
				<div class="widget-thumb-body">
					<span class="widget-thumb-subtitle">总计（个）</span> <span
						class="widget-thumb-body-stat" data-counter="counterup"
						data-value="5,071">{{ $repair_order_count }}</span>
				</div>
			</div>
		</div>
		<!-- END WIDGET THUMB -->
	</div>
</div>