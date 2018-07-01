<nav class="main-navigation" aria-label="<?php esc_html_e( 'Primary Menu', 'umbala' ); ?>">
	<?php 
	wp_nav_menu( array('theme_location' => 'primary', 'walker' => new Umbala_Mega_Menu_Walker()) );
	 ?>
</nav><!-- #site-navigation -->