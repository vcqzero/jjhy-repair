@extends('admin.layout.modal') @section('title', '查看')
@section('pageGroup', 'Workyard') @section('pageName', 'ViewPage')

@section('modalSize', 'modal-lg') @section('modalBody')
@include('admin.workyard.partial.panel-workyard-basic-info')
@include('admin.workyard.partial.panel-workyard-check-history')
@endsection
