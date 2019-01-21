@extends('admin.layout.modal') @section('title', '审核')
@section('pageGroup', 'Workyard') @section('pageName', 'CheckPage')

@section('modalSize', 'modal-lg') @section('modalBody')
@include('admin.workyard.partial.panel-workyard-basic-info')
@include('admin.workyard.partial.panel-workyard-check-history')
@include('admin.workyard.partial.panel-workyard-check')
@endsection