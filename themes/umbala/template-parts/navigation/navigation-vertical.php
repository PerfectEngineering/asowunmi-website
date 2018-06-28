<div class="alus-vertical-navigation">
	<div class="vertical-menu-heading">
		<i class="icon-menu"></i>
		<?php echo umbala_get_vertical_menu_heading(); ?>                            
	</div>
	<div class="vertical-menu vertical-menu-dropdown">
		<?php wp_nav_menu( array(
			'theme_location' => 'vertical',
			'menu_id'        => 'vertical-menu',
			'walker' => new Umbala_Mega_Menu_Walker()
			) ); ?>
		</div>
	</div>
