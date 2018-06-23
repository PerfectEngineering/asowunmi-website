<?php 
global $post, $wp_query;
$post_format = get_post_format();
$post_class = 'blog-post-default post-item hentry';
$show_blog_thumbnail = umbala_get_opt('alus_blog_thumbnail');
?>

<article id="post-<?php the_ID(); ?>" <?php post_class($post_class) ?>>
	<?php if( $post_format != 'quote' ): ?>
		<header class="entry-header">
			<?php if( $show_blog_thumbnail ): ?>
				<?php umbala_post_thumb( array( 'size' => 'full', 'class' => 'post-image' ) ); ?>
			<?php endif; ?>
		</header>

		<div class="entry-content">

			<!-- Title -->
			<?php if( umbala_get_opt('alus_blog_title') ): ?>
				<h3 class="entry-title">
					<a class="post-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>

					<?php if ( is_sticky() && is_home() && ! is_paged() ) {
						printf( '<span class="sticky-post">%s</span>', esc_html__( 'Featured', 'umbala' ) );
					} ?>
				</h3>
			<?php endif; ?>

			<!-- Date Time -->
			<?php if( umbala_get_opt('alus_blog_date') ) : ?>
				<div class="date-time">
					<i class="fa fa-calendar"></i> <?php echo get_the_time(get_option('date_format')); ?>
				</div>
			<?php endif; ?>

			<!-- Author -->
			<?php if( umbala_get_opt('alus_blog_author') ): ?>
				<span class="vcard author"><?php esc_html_e('Posted by ', 'umbala'); ?>
				<?php echo get_avatar( get_the_author_meta( 'ID' ), 32 ); ?>
				<?php the_author_posts_link(); ?></span>
			<?php endif; ?>

			<!-- View -->
			<?php if( umbala_get_opt('alus_blog_count_view') ): ?>
				<span class="count-view">
					<?php echo esc_html_e('View: ','umbala');?>
					<?php echo umbala_get_post_views(get_the_ID()); ?>
				</span>
			<?php endif; ?>

			<div class="entry-summary">
				<?php if( umbala_get_opt('alus_blog_excerpt') ): ?>
					<div class="blog-content">
						<?php 
						$max_words = (int) umbala_get_opt('alus_blog_excerpt_max_words')?(int) umbala_get_opt('alus_blog_excerpt_max_words'):125;
						$strip_tags = umbala_get_opt('alus_blog_excerpt_strip_tags')?true:false;
						umbala_the_excerpt_max_words($max_words, $strip_tags, ' ', true); 
						?>
					</div>
				<?php endif; ?>

				<?php if( umbala_get_opt('alus_blog_read_more') ): ?>
					<a class="button-readmore" href="<?php the_permalink() ; ?>"><?php esc_html_e('Continue Reading', 'umbala'); ?></a>
				<?php endif; ?>

				<!-- Comment -->
				<?php if( umbala_get_opt('alus_blog_comment') ): ?>
					<?php 
					if ( get_comments_number() == 0 ) {
						$comments = esc_html__( 'No Comments', 'umbala' );
					} elseif ( get_comments_number() > 1 ) {
						$comments = sprintf( esc_html__( '%s Comments', 'umbala' ), get_comments_number() );
					} else {
						$comments = esc_html__( '1 Comment', 'umbala' );
					}
					echo '<a class="comment" href="' . get_comments_link() . '"><i class="fa fa-comments"></i> ' . $comments . '</a>';
					?>
				<?php endif; ?>
			</div><!-- .entry-summary -->
			
			<?php if(umbala_get_opt('alus_blog_tags') || umbala_get_opt('alus_blog_categories')): ?>
			<div class="entry-footer">
				<!-- Categories -->
				<?php $categories_list = get_the_category_list(', '); ?>
				<?php if ( $categories_list && umbala_get_opt('alus_blog_categories') ): ?>
					<div class="cats-link">
						<span><?php esc_html_e('Categories: ', 'umbala'); ?></span>
						<span class="cat-links"><?php echo trim($categories_list); ?></span>
					</div>        
				<?php endif; ?>

				<!-- Tags -->
				<?php   
				$tags_list = get_the_tag_list('', ', '); 
				if ( $tags_list && umbala_get_opt('alus_blog_tags') ): ?>
					<span class="tags-link">
						<span><?php esc_html_e('Tags: ','umbala');?></span>
						<span class="tag-links">
							<?php echo trim($tags_list); ?>
						</span>
					</span>
				<?php endif; ?> 
			</div>
		<?php endif; ?>
	</div><!-- .entry-content -->

<?php else: /* Post format is quote */ ?>

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
		<?php if( umbala_get_opt('alus_blog_date') ): ?>
			<!-- Blog Date -->
			<span class="date-time">
				<i class="fa fa-calendar"></i>
				<?php echo get_the_time( get_option('date_format')); ?>
			</span>
		<?php endif; ?>

		<!-- Author -->
		<?php if( umbala_get_opt('alus_blog_author') ): ?>
			<span class="vcard author"><?php esc_html_e('Posted by: ', 'umbala'); ?><?php the_author_posts_link(); ?></span>
		<?php endif; ?>
	</div>
<?php endif; ?>
</article>
