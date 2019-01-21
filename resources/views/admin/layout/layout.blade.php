<html lang="en">
	<head>
        @include('admin.layout.partial.head')
    </head>
     
	<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo page-sidebar-fixed">
        <!-- top -->
        @include('admin.layout.partial.top')
     	<div class="clearfix"> </div>
        <div class="page-container">
        	<!-- sidebar -->
        	@include('admin.layout.partial.sidebar')
        	<div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- page title -->
                    @include('admin.layout.partial.page-title')
                    <!-- page-breadcrumb -->
                    @include('admin.layout.partial.page-breadcrumb')
                    <!-- page-content -->
                    <div class="row">
    					<div class="col-md-12">
        					<div class="main-page" data-name="@yield('pageName')" data-group="@yield('pageGroup')">
                        	@yield('content')
                        	</div>
                    	</div>
                    </div>
                </div>
             </div>
     	</div>
     	<!-- footer -->
     	@include('admin.layout.partial.footer')
     	@csrf
     </body>
     <!-- js -->
     @include('admin.layout.partial.js')
</html>
