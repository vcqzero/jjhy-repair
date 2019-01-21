@extends('admin.layout.modal') @section('title', '维修单信息')
@section('pageGroup', 'RepairOrder') @section('pageName', 'ViewPage')

@section('modalSize', 'modal-lg') @section('modalBody')
	@include('admin.repair-order.partial.panel-workyard')
    @include('admin.repair-order.partial.panel-order')
    <!-- 如果有维修工程师接单 -->
    @if($repairOrder->worker_id > 0)
    @include('admin.repair-order.partial.panel-worker')
    @endif
@endsection
