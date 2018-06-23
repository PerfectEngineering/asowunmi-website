<?php 
/**
 *	Template Name: Fullwidth Template
 */
global $umbala_page_options;
get_header();
umbala_page_heading();
?>
<div class="container-fluid">
	<section id="content" class="site-content">
		<?php 
		if( umbala_is_woocommerce_activated() ){
			wc_print_notices();
		}
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php 
			if( have_posts() ) the_post();
			the_content();
			wp_link_pages();
			?>
		</article>
	</section><!-- #content -->
</div><!-- .container-fluid -->

<?php get_footer(); ?>