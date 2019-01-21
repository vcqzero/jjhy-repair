<div class="page-header navbar navbar-fixed-top">
	<!-- BEGIN HEADER INNER -->
	<div class="page-header-inner ">
		<!-- BEGIN LOGO -->
		@include('admin.layout.partial.top-logo')
		<!-- END LOGO -->

		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a href="javascript:;" class="menu-toggler responsive-toggler"
			data-toggle="collapse" data-target=".navbar-collapse"> </a>

		<!-- BEGIN PAGE ACTIONS -->
<!-- 		@include('admin.layout.partial.top-action') -->
		<!-- END PAGE ACTIONS -->

		<div class="page-top">
			<div class="top-menu">
				<ul class="nav navbar-nav pull-right">
					<li class="separator hide"></li>
					<li class="separator hide"></li>
					<li class="separator hide"></li>
					@include('admin.layout.partial.top-nav-profile')
				</ul>
			</div>
		</div>
		
	</div>
</div>