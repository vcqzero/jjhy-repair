<!DOCTYPE html>
<html lang="en">
    <head>
    @include('admin.layout.partial.head')
    <link href="/_admin/css/login-3.css" rel="stylesheet">
    </head>
    <!-- END HEAD -->

    <body class=" login">
        <!-- BEGIN LOGO -->
        <div class="logo">
        <img class="login" src="/storage/website/admin/logo/logo.png">
        </div>
        <div class="content">
            @yield('content')
            <!-- footer -->
			<div class="muted">
        		{{ $record }}
        	</div>
        </div>
        @csrf
    </body>
	<!-- js -->
	@include('admin.layout.partial.js')
</html>