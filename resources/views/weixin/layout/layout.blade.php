<!DOCTYPE html>
<html>
<head>
<title>@yield('title')-{{ $title }}</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport"
	content="width=device-width, initial-scale=1, user-scalable=no">
<meta content="" name="description" />
<meta content="qinchong" name="author" />
<link rel="shortcut icon" href="{{$ico}}" />
@include('weixin.layout.partial.css')
</head>

<body ontouchstart>
	@yield('page-title')
	<div class="page main-page" data-group="@yield('pageGroup')" data-name="@yield('pageName')" 
	style="height: 100%">
	@yield('content')
	@csrf
	</div>
	<!-- js -->
	@include('weixin.layout.partial.js')
</body>
</html>

