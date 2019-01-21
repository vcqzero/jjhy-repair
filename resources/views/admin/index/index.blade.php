@extends('admin.layout.layout')
@section('title', '首页')
@section('pageName', 'IndexPage')
@section('pageGroup', 'Index')
@section('content')
<!-- count -->
@include('admin/index/partial/count')
<!-- working -->
<div class="row">
<!-- 派单 -->
@include('admin/index/partial/wait-distribute')
<!-- 审核维修工程师 -->
@include('admin/index/partial/check-worker')
<!-- 审核项目 -->
@include('admin/index/partial/check-workyard')
</div>
@endsection