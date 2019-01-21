<div class="page-sidebar-wrapper">
	<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar navbar-collapse collapse" style="min-height: 700px">
		<!-- BEGIN SIDEBAR MENU -->
		<!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
		<!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
		<!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
		<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
		<!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
		<!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
		<ul 
		class="page-sidebar-menu" 
		data-keep-expanded="true"
		data-auto-scroll="true" 
		data-slide-speed="200">
			<?php foreach ($all_section_menus as $section):?>
			<?php 
			$section_title = $section['section-title'] ?? '';
			$menus = $section['menus'];
			?>
			<?php if(!empty($section_title)):?>
			<li class="heading">
				<h3 class="uppercase"><?=$section_title?></h3>
			</li>
			<?php endif;?>
    			<?php foreach ($menus as $menu):?>
    			<?php 
    			$icon  = $menu['icon'];
    			$title = $menu['title'];
    			$submenus = $menu['submenus'];
    			?>
    			<li class="nav-item start ">
    			<a 
    			href="javascript:;"
    			class="nav-link nav-toggle"> 
    				<i class="<?=$icon?>"></i> 
    				<span
    				class="title"><?=$title?></span> 
    				<span class="arrow"></span>
    			</a>
    				<!-- /sub men -->
    				<ul class="sub-menu">
    					<?php foreach ($submenus as $submenu):?>
    					<?php 
    					$icon = $submenu['icon'];
    					$href = $submenu['href'];
    					$title= $submenu['title'];
    					?>
    					<li class="nav-item start ">
    					<a href="<?=$href?>" class="nav-link ">
    						<i class="<?=$icon?>"></i> <span class="title"><?=$title?></span>
    					</a>
    					</li>
    					<?php endforeach;?>
    				</ul>
    				<!-- /end sub men -->
    			</li>
    			<?php endforeach;?>
			<?php endforeach;?>
		</ul>
		<!-- END SIDEBAR MENU -->
	</div>
	<!-- END SIDEBAR -->
</div>