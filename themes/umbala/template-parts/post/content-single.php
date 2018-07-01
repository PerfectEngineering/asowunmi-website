<?php 

global $post, $wp_query;
$post_format = get_post_format();
$post_class = 'post-item hentry';
$show_blog_thumbnail = umbala_get_opt('alus_blog_details_thumbnail');
umbala_set_post_views(get_the_ID());
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($post_class) ?>>

	<?php if( $post_format != 'quote' ): ?>
		<header class="entry-header">
			<?php if( $show_blog_thumbnail ): ?>
				<?php if( $post_format == 'gallery' || $post_format === false || $post_format == 'standard' ): ?>
					<div class="blog-image <?php echo esc_attr($post_format); ?> <?php echo ($post_format == 'gallery')?'loading owl-carousel':''; ?>">
						<?php 
						if( $post_format == 'gallery' ){
							$gallery = get_post_meta($post->ID, 'alus_gallery', true);
							foreach( (array)$gallery as $gallery_id => $gallery_url ){
								echo wp_get_attachment_image( $gallery_id, 'full', 0, array('class' => 'single-post-image') );
							}
						}
						if( $post_format === false || $post_format == 'standard' ){
							if( has_post_thumbnail() ) {
								the_post_thumbnail('full', array('class' => 'single-post-image'));
							}
						}
						?>
					</div>
				<?php endif;

				if( $post_format == 'video' ) {
					$video_url = get_post_meta($post->ID, 'alus_video_url', true);
					if( !empty($video_url) ){
						echo do_shortcode('[alus_video src="'.esc_url($video_url).'"]');
					}
				}

				if( $post_format == 'audio' ){
					$audio_url = get_post_meta($post->ID, 'alus_audio_url', true);
					if( !empty($audio_url) ){
						$file_format = substr($audio_url, -3, 3);
						if( in_array($file_format, array('mp3', 'ogg', 'wav')) ){
							echo do_shortcode('[audio '.$file_format.'="'.$audio_url.'"]');
						} else {
							echo do_shortcode('[alus_soundcloud url="'.$audio_url.'" width="100%" height="166"]');
						}
					}
				}
				?>
			<?php endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<div class="info-category">

				<!-- Date Time -->
				<?php if( umbala_get_opt('alus_blog_details_date') ) : ?>					
					<div class="date-time date-time-meta">
						<i class="fa fa-calendar"></i> <?php echo get_the_time(get_option('date_format')); ?>
					</div>
				<?php endif; ?>

				<!-- Post by -->
				<?php if( umbala_get_opt('alus_blog_author') ): ?>					
					<span class="vcard author"><?php esc_html_e('Posted by ', 'umbala'); ?>
					<?php echo get_avatar( get_the_author_meta( 'ID' ), 32 ); ?>
					<?php the_author_posts_link(); ?></span>
				<?php endif; ?>
			</div><!-- .info-category -->
			<div class="clear"></div>

			<!-- Content -->
			<?php if( umbala_get_opt('alus_blog_details_content') ): ?>
				<div class="entry-summary">
					<div class="full-content"><?php the_content(); ?></div>
					<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'umbala' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
				</div><!-- .entry-summary -->
			<?php endif; ?>

			<div class="footer-single-post">
				<!-- Category -->
				<?php $categories_list = get_the_category_list(', '); ?>
				<?php if ( $categories_list && umbala_get_opt('alus_blog_details_categories') ): ?>
					<div class="cats-link">
						<span><?php esc_html_e('Categories: ','umbala'); ?></span>
						<span class="cat-links"><?php echo trim($categories_list); ?></span>
					</div>
				<?php endif; ?> 

				<!-- Social Sharing -->
				<?php if( umbala_get_opt('alus_blog_details_sharing') && function_exists('alus_template_social_sharing' ) ): ?>
					<?php alus_template_social_sharing(); ?>
				<?php endif; ?>

				<!-- Tags -->
				<?php   
				$tags_list = get_the_tag_list('', ', '); 
				if ( $tags_list && umbala_get_opt('alus_blog_details_tags') ): ?>
				<span class="tags-link">
					<span><?php esc_html_e('Tags: ','umbala'); ?></span>
					<span class="tag-links">
						<?php echo trim($tags_list); ?>
					</span>
				</span>
			<?php endif; ?> 
		</div>
	</div><!-- .entry-content -->

<?php else: ?>

	<blockquote class="blockquote-bg">
		<?php 
		$quote_content = get_the_excerpt();
		if( !$quote_content ){
			$quote_content = get_the_content();
		}
		echo do_shortcode($quote_content);
		?>
	</blockquote>

	<div class="blockquote-meta">
		<!-- Date Time -->
		<?php if( umbala_get_opt('alus_blog_details_date') ) : ?>					
			<div class="date-time date-time-meta">
				<i class="fa fa-calendar"></i> <?php echo get_the_time(get_option('date_format')); ?>
			</div>
		<?php endif; ?>

		<!-- Post by -->
		<?php if( umbala_get_opt('alus_blog_author') ): ?>					
			<span class="vcard author"><?php esc_html_e('Posted by: ', 'umbala'); ?><?php the_author_posts_link(); ?></span>
		<?php endif; ?>
	</div>

<?php endif; ?>

</article>

<!-- Author box -->
<?php if( umbala_get_opt('alus_blog_details_author_box') && get_the_author_meta('description') ) : ?>
	<div class="entry-author">
		<div class="author-avatar">
			<?php
			echo get_avatar( get_the_author_meta( 'user_email' ), 90 );
			?>
		</div>
		<div class="author-desc">
			<h3 class="author-name">
				<?php echo esc_html( get_the_author_meta( 'display_name' ) ); ?>
			</h3>
			<p class="author-bio">
				<?php the_author_meta( 'description' ); ?>
			</p>
			<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
				<?php printf( esc_html__( 'View all posts by %s ', 'umbala' ), get_the_author() ); ?>
			</a>
		</div>
	</div><!-- .entry-author -->
<?php endif; ?>

<!-- Single Navigation -->
<?php if( umbala_get_opt('alus_blog_details_navigation') ): ?>
	<div class="nav-single-post">
		<?php
		$next_post = get_next_post();
		$prev_post = get_previous_post();
		?>
		<?php if( !empty($prev_post) ) : ?>
			<a class="order-posts" href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>" rel="prev">
				<i class="fa fa-long-arrow-left"></i>
				<span class="post-title"><?php echo get_the_title($prev_post->ID); ?></span>
			</a>
		<?php endif; ?>

		<?php if( !empty($next_post) ) : ?>
			<a class="newer-posts" href="<?php echo esc_url(get_permalink($next_post->ID)); ?>" rel="next">
				<span class="post-title"><?php echo get_the_title($next_post->ID); ?></span>
				<i class="fa fa-long-arrow-right"></i>
			</a>
		<?php endif; ?>
	</div><!-- .single-post-navigation -->
<?php endif; ?>

<!-- Related Post -->
<?php 
if( umbala_get_opt('alus_blog_details_related_posts') ){
	get_template_part('template-parts/post/related-posts');
}

/* * Comment Template * */
if ( umbala_get_opt('alus_blog_details_comment_form') ){
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;
}
?>
