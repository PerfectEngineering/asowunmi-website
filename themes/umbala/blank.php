<?php 
/**
 *	Template Name: Blank Page Template
 */	
?>
<?php get_header(); ?>
<div class="container">
	<div class="row">
		<section id="content" class="site-content col-sm-12">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
				<?php if(have_posts()): while(have_posts()) : the_post(); ?>

                    <?php the_content(); ?>

                <?php endwhile; else: ?>

                    <h3><?php esc_html_e('No pages were found!', 'umbala') ?></h3>

                <?php endif; ?>
				
			</article>
		</section><!-- #content -->
	</div><!-- .row -->
</div><!-- .container -->
<?php get_footer(); ?>