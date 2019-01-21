@extends('admin.layout.modal') @section('title', '维修工程师信息')
@section('pageGroup', 'Worker') @section('pageName', 'ViewPage')

@section('modalSize', 'modal-lg') @section('modalBody')
@include('admin.user.partial.panel-basic', [ 'user' => $worker])
@include('admin.worker.partial.panel-worker')
@endsection
