@extends('admin.layout.modal') @section('title', '审核')
@section('pageGroup', 'Worker') @section('pageName', 'CheckPage')

@section('modalSize', 'modal-lg') @section('modalBody')
	<!-- 基本信息 -->
	@include('admin.user.partial.panel-basic', [ 'user' => $worker])
    <!-- 维修技能 -->
    @include('admin.worker.partial.panel-worker')
    <!-- 保险单信息 -->
    @include('admin.worker.partial.panel-worker-certificate')
    <!-- 审核信息 -->
    @include('admin.worker.partial.panel-worker-check')
@endsection