@extends('admin.layout.modal') @section('title', '工地管理员信息')
@section('pageGroup', 'WorkyardAdmin') @section('pageName', 'ViewPage')

@section('modalSize', 'modal-lg') @section('modalBody')
@include('admin.user.partial.panel-basic')
@include('admin.workyard-admin.partial.panel-workyard-admin')
@endsection
